<?php

namespace Tests\Unit\Services;

use App\Services\Images\ImageService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ImageServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $image;

    protected function setUpImage(): void
    {
        $this->image = UploadedFile::fake()->image('test1.png');
    }
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_upload()
    {
        $this->setUpImage();
        $imagePath = ImageService::upload($this->image);

        $this->assertEquals(
            1,
            preg_match('/public\/([a-zA-Z0-9]{2}\/)+[a-zA-Z0-9]+\.(png|jpg|jpeg)/', $imagePath)
        );

        $this->assertEquals(
            1,
            is_file(storage_path(). '/app/' . $imagePath)
        );

        ImageService::remove($imagePath);

    }

    public function test_remove()
    {
        $this->setUpImage();
        $imagePath = ImageService::upload($this->image);

        ImageService::remove($imagePath);

        $this->assertEquals(
            0,
            is_file(storage_path(). '/app/' . $imagePath)
        );

    }
}
