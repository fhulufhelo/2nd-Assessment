<?php

use app\Database;

class Publication 
{
	public $db;
	public $main_publication_business_day = [];
	public $business_day_region
	public $article;
	
	function __construct()
	{
		$this->db = new Database();
		$this->main_publication_business_day = $this->db->get();
	}


	public function save()
	{
		$this->business_day_region = $this->db->create(['Name' => 'Business Day KZN']);

		foreach ($this->main_publication_business_day as $duplicate) {

			$this->article = $this->db->create([
				'Title' =>$duplicate->article->Title,
				'Author' = $duplicate->pages->article->Author,
				'Content' = $duplicate->pages->article->Content,
				'Start_Page_Id' = $duplicate->pages->article->Start_Page_Id
			]);


			if (count(($duplicate->pages) > 1) {
				$this->create_page_artice($duplicate);
			} else {
				$this->create_page_artice($duplicate);
			}
			
			
		}
	}


	public function create_page_artice($duplicate)
	{
		$page = $this->db->create([
			'Publication_ID' =>$this->business_day_region->id,
			'Jpeg_Location' = $duplicate->pages->Jpeg_Location,
			'Page_Number' = $duplicate->pages->Page_Number
		]);

		$image = $this->db->create([
			'Article_ID' =>$duplicate->$this->article->id,
			'Page_ID' = $duplicate->$page->id,
			'X_coords' = $duplicate->pages->image->X_coords,
			'Y_coords' = $duplicate->pages->image->Y_coords,
			'Width' = $duplicate->pages->image->Width,
			'Height' = $duplicate->pages->image->Height
		]);
	}

}
