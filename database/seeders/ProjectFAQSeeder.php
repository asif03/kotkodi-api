<?php

namespace Database\Seeders;

use App\Models\ProjectFaq;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectFAQSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProjectFaq::truncate();
        $data = [
            [
                'id'         => 1,
                'question'   => 'Are your products vegan?',
                'answer'     => 'Our Southeast Asian Box is vegan-compatible. When selecting your choice of sambal, simply ensure that you choose the Malaysian Seaweed Sambal in place of the Malaysian Crispy Sambal. The add on Laksa Noodle Kit is not vegan, so please forego this add on if you are vegan.',
                'project_id' => 1,
                'created_by' => 1,
            ],
            [
                'id'         => 2,
                'question'   => 'Are your products gluten-free?',
                'answer'     => 'Yes, all our products are gluten-free. This includes the noodles provided with the Laksa Noodle Kit which are made with rice flour.',
                'project_id' => 1,
                'created_by' => 1,
            ],
            [
                'id'         => 3,
                'question'   => 'Where can I access nutritional information?',
                'answer'     => 'A link to a download-ready PDF of nutritional information is available on the main Kickstarter campaign page (below "Pantry Box Deep Dive"). Please note that final nutritional information and ingredients list may be subject to change since the current information is derived from prototypes.',
                'project_id' => 1,
                'created_by' => 1,
            ],
            [
                'id'         => 4,
                'question'   => 'Can I get extra items? What are Add-Ons!',
                'answer'     => "If there's an item in particular that's not part of your reward tier, or that you'd like to pick up an extra item of, you can do this with Add-Ons! Once you've selected your pledge, at the checkout you'll be asked if you want to add on extras from the selection available.",
                'project_id' => 2,
                'created_by' => 1,
            ],
            [
                'id'         => 5,
                'question'   => 'If I choose a tier that comes with a physical and digital copy of the game, or add extra copies, can I pick different platforms for each copy?',
                'answer'     => "Yes! You'll receive a survey sometime after the campaign closes to make platform selections for each. Each copy has an independent selection.",
                'project_id' => 2,
                'created_by' => 1,
            ],
            [
                'id'         => 6,
                'question'   => 'Does PC include Linux? What about Steam Deck?',
                'answer'     => "Yes, and yes! Paper Animal RPG will be natively supported on Steam Deck.",
                'project_id' => 2,
                'created_by' => 1,
            ],
        ];

        DB::table('project_faqs')->insert($data);
    }
}