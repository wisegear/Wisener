<?php

namespace Tests\Feature;

use App\Services\ImageService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class ImageServiceTest extends TestCase
{
    private string $temporaryPublicPath;

    protected function setUp(): void
    {
        parent::setUp();
        $this->temporaryPublicPath = sys_get_temp_dir().'/site-images-'.bin2hex(random_bytes(8));
        $this->app->usePublicPath($this->temporaryPublicPath);
        File::makeDirectory(public_path('assets/images/uploads/galleries'), 0755, true);
    }

    protected function tearDown(): void
    {
        File::deleteDirectory($this->temporaryPublicPath);
        parent::tearDown();
    }

    public function test_featured_upload_creates_all_sizes(): void
    {
        $name = app(ImageService::class)->handleImageUpload(UploadedFile::fake()->image('featured.jpg', 1600, 1000));
        $this->assertFileExists(public_path('assets/images/uploads/'.$name));
        foreach (['small_' => [350, 200], 'medium_' => [800, 300], 'large_' => [1200, 400]] as $prefix => $size) {
            $this->assertSame($size, array_slice(getimagesize(public_path('assets/images/uploads/'.$prefix.$name)), 0, 2));
        }
    }

    public function test_gallery_upload_creates_original_and_thumbnail(): void
    {
        $images = app(ImageService::class)->handleGalleryImageUpload(UploadedFile::fake()->image('gallery.png', 900, 600));
        $this->assertFileExists(public_path('assets/images/uploads/galleries/'.$images['original']));
        $this->assertSame([350, 200], array_slice(getimagesize(public_path('assets/images/uploads/galleries/'.$images['thumbnail'])), 0, 2));
    }

    public function test_inline_image_keeps_its_dimensions_and_can_be_deleted(): void
    {
        $service = app(ImageService::class);
        $path = $service->optimizeAndSaveImage(UploadedFile::fake()->image('inline.jpg', 640, 480));
        $this->assertSame([640, 480], array_slice(getimagesize(public_path($path)), 0, 2));
        $service->deleteImage($path);
        $this->assertFileDoesNotExist(public_path($path));
    }

    public function test_link_image_is_cropped_to_square(): void
    {
        $name = app(ImageService::class)->handleLinkImageUpload(UploadedFile::fake()->image('link.jpg', 900, 600));
        $this->assertSame([200, 200], array_slice(getimagesize(public_path('assets/images/uploads/'.$name)), 0, 2));
    }
}
