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
		// initialize database
		$this->db = new Database();

		// Retrive Main publication of the business day

		$this->main_publication_business_day = $this->db->get();
	}


	//  This controller method handle the creation of new region publication business day 

	public function save()
	{
		// create parent publication of Pages,Articles and Images
		$this->business_day_region = $this->db->create(['Name' => 'Business Day KZN']);


		// loop through the main publication business day and save duplicate to their region

		foreach ($this->main_publication_business_day as $duplicate) {

			/**
			* as Article has one to many relationship ( two page can belong to one article )
			* I created it first and save its object that will be later used when creating its corresponding child ( Image)
			*  $this->db->create return created object
			*/

			$this->article = $this->db->create([
				'Title' =>$duplicate->article->Title,
				'Author' = $duplicate->pages->article->Author,
				'Content' = $duplicate->pages->article->Content,
				'Start_Page_Id' = $duplicate->pages->article->Start_Page_Id
			]);


			// if we have more than one pages per article, 
			// let loop though each pages and create create each page before assign it to article


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
