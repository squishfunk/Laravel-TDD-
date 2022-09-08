<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Book;

class BookReservationTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_book_can_be_added_to_the_library(){

        $this->withoutExceptionHandling();

        $response = $this->post('/books', [
            'title' => 'Cool',
            'author' => 'Damian Kitlas'
        ]);


        $response->assertOk();
        $this->assertCount(1, Book::all());
    }

    /** @test */
    public function a_title_is_required(){
        $response = $this->post('/books', [
            'title' => '',
            'author' => 'Damian Kitlas'
        ]);


        $response->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_author_is_required(){
        $response = $this->post('/books', [
            'title' => 'Cool title',
            'author' => ''
        ]);

        $response->assertSessionHasErrors('author');
    }

    /** @test */
    public function a_book_can_be_updated(){
        $this->withoutExceptionHandling();

        /* Create */
        $response = $this->post('/books', [
            'title' => 'Cool title',
            'author' => 'Damian Kitlas'
        ]);
        $id = Book::first()->id;
        /* Update */
        $response = $this->patch('/books/'.$id, [
            'title' => 'New title',
            'author' => 'Damian Kitlas'
        ]);

        $this->assertEquals('New title', Book::first()->title);
    }
}
