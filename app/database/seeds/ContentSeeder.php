<?php

class ContentSeeder extends Seeder {

  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Eloquent::unguard();

    $contentType = ContentType::create([
      'name' => 'Blog',
      'slug' => 'blog',
    ]);

    $titleRegion = Region::create([
      'name' => 'Title',
      'slug' => 'title',
    ]);
    $contentType->regions()->attach($titleRegion);

    $bodyRegion = Region::create([
      'name' => 'Body',
      'slug' => 'body',
    ]);
    $contentType->regions()->attach($bodyRegion);

    $textBlock = Block::create([
      'name' => 'Text',
      'slug' => 'text',
    ]);

    $textBlockContentField = new Field([
      'name' => 'Content',
      'slug' => 'content',
      'type' => 'text',
    ]);
    $textBlock->fields()->save($textBlockContentField);

    $paragraphBlock = Block::create([
      'name' => 'Paragraph',
      'slug' => 'paragraph',
    ]);

    $blockquoteBlock = Block::create([
      'name' => 'Blockquote',
      'slug' => 'blockquote',
    ]);

    $blockquoteQuoteField = new Field([
      'name' => 'Quote',
      'slug' => 'quote',
      'type' => 'text',
    ]);
    $blockquoteBlock->fields()->save($blockquoteQuoteField);

    $blockquoteCiteField = new Field([
      'name' => 'Cite',
      'slug' => 'cite',
      'type' => 'text',
    ]);
    $blockquoteBlock->fields()->save($blockquoteCiteField);
  }

}