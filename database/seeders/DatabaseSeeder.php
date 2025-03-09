<?php

namespace Database\Seeders;

use App\Models\Discussion;
use App\Models\Topic;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class DatabaseSeeder extends Seeder {
	/** @var array<string> */
	protected array $topics = [ 'laravel', 'livewire', 'inertia', 'php' ];
	/** @var array<string , array<string>> $discussionTitles */
	protected array $discussionTitles = [ 
		'laravel' => [ 
			'Best Practices for Laravel Authentication',
			'Optimizing Laravel Performance for Large Applications',
			'How to Use Laravel Queues Effectively',
			'Building RESTful APIs with Laravel',
			'Exploring Laravel Livewire Integration'
		],
		'livewire' => [ 
			'Optimizing Livewire Components for High-Traffic Applications',
			'Using Livewire with Alpine.js for Dynamic UI',
			'Best Practices for Livewire Event Handling',
			'How to Debug Livewire Applications Efficiently',
			'Creating Reusable Livewire Components'
		],
		'inertia' => [ 
			'Getting Started with Inertia.js and Laravel',
			'Building Single Page Applications with Inertia.js',
			'How to Handle Form Submissions in Inertia.js',
			'Optimizing Inertia.js for Better Performance',
			'Using Inertia.js with Vue or React'
		],
		'php' => [ 
			'PHP 8 Features You Should Know About',
			'How to Secure Your PHP Applications',
			'Building a Discussion Forum with PHP and MySQL',
			'Best Practices for PHP Error Handling',
			'Exploring Object-Oriented Programming in PHP'
		]
	];

	/**
	 * Seed the application's database.
	 */
	public function run(): void {
		// User::factory(10)->create();

		User::factory()->create( [ 
			'name' => 'admin',
			'username' => 'Eslam Kamel',
			'email' => 'admin@gmail.com',
		] );
		User::factory()->create( [ 
			'name' => 'selia',
			'username' => 'Selia Eslam',
			'email' => 'selia@gmail.com',
		] );
		collect( $this->topics )->each( function (string $topic, int $index) {
			/** @var Topic $topicModel */
			$topicModel = Topic::create( [ 
				'name' => str( $topic )->upper(),
				'slug' => str( $topic )->slug(),
				'created_at' => now()->subYear()->addDays( $index ),
				'updated_at' => now()->subYear()->addDays( $index ),
			] );
			collect( $this->discussionTitles[ $topic ] )->each( function ($title, $index) use ($topicModel) {
				Discussion::create( [ 
					'user_id' => User::inRandomOrder()->first()->id,
					'topic_id' => $topicModel->id,
					'title' => $title,
					'slug' => fake()->slug(),
					'created_at' => now()->subYear()->addDays( $index ),
					'updated_at' => now()->subYear()->addDays( $index ),
				] );
			} );
		} );
	}
}
