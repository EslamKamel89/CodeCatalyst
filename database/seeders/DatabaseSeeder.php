<?php

namespace Database\Seeders;

use App\Models\Topic;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
	/** @var array<string> */
	protected array $topics = [ 'laravel', 'livewire', 'inertia', 'php' ];
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
			Topic::create( [ 
				'name' => str( $topic )->upper(),
				'slug' => str( $topic )->slug(),
				'created_at' => now()->subYear()->addDays( $index ),
				'updated_at' => now()->subYear()->addDays( $index ),
			] );
		} );
	}
}
