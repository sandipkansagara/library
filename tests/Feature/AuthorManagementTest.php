<?php

namespace Tests\Feature;

use Illuminate\Support\Carbon;
use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthorManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_an_author_can_be_created(){
        $this->withoutExceptionHandling();
        
        $this->post('/author', [
            'name' => 'Author Name',
            'dob' => '05/14/1984'
        ]);

        $author = Author::all();
        $this->assertCount(1, $author);

        //dd($author->first()->dob);

        $this->assertInstanceOf(Carbon::class, $author->first()->dob);
        $this->assertEquals('1984/14/05', $author->first()->dob->format('Y/d/m'));
    }
}
