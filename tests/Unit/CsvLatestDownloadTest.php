<?php

namespace Tests\Feature;

use App\Models\CsvRow;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CsvLatestDownloadTest extends TestCase
{
    use RefreshDatabase;
        public function probar_que_se_obtiene_el_ultimo_registro(): void
    {
        $firstRow = CsvRow::create(['data' => ['name' => 'first']]);
        $latestRow = CsvRow::create(['data' => ['name' => 'latest']]);

        $response = $this->get(route('csv.latest-download'));

        $response->assertOk();
        $response->assertHeader('Content-Type', 'text/plain; charset=UTF-8');
   
        $this->assertNotSame(
            json_encode($firstRow->data, JSON_PRETTY_PRINT),
            $response->streamedContent()
        );
        $this->assertSame(
            json_encode($latestRow->data, JSON_PRETTY_PRINT),
            $response->streamedContent()
        );
    }
}