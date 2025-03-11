<?php

namespace Database\Seeders;

use App\Models\Discussion;
use App\Models\Post;
use App\Models\Topic;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class DatabaseSeeder extends Seeder {
	/** @var array<string> */
	protected array $topics = [ 'laravel', 'livewire', 'inertia', 'php' ];

	protected array $discussionTitles = [ 
		'laravel' => [ 
			'Best Practices for Laravel Authentication' => [ 
				'I prefer using Laravel Sanctum for secure SPA authentication.',
				'Don\'t forget to hash passwords and implement rate limiting for login attempts.',
			],
			'Optimizing Laravel Performance for Large Applications' => [ 
				'Implementing caching with Redis significantly improved our response times.',
				'Using eager loading has reduced our N+1 query issues dramatically.',
			],
			'How to Use Laravel Queues Effectively' => [ 
				'I set up Redis queues and it cut our response time in half.',
				'Horizon helped me monitor jobs and optimize the queue processing.',
			],
			'Building RESTful APIs with Laravel' => [ 
				'API resources in Laravel make it easy to structure consistent JSON responses.',
				'Versioning APIs early has helped us maintain backward compatibility.',
			],
			'Exploring Laravel Livewire Integration' => [ 
				'Integrating Livewire boosted interactivity without sacrificing SEO.',
				'Combining Livewire and Alpine.js has created a lightweight reactive UI.',
			],
		],
		'livewire' => [ 
			'Optimizing Livewire Components for High-Traffic Applications' => [ 
				'Using wire:model with a debounce reduced excessive server calls in high-load scenarios.',
				'I refactored my components to chunk data loading, which improved performance significantly.',
			],
			'Using Livewire with Alpine.js for Dynamic UI' => [ 
				'The synergy between Livewire and Alpine.js creates a seamless dynamic interaction.',
				'I appreciate how easy it is to bind Alpine.js properties within Livewire components.',
			],
			'Best Practices for Livewire Event Handling' => [ 
				'Centralizing event listeners within components helps to avoid duplicate code.',
				'Using $emit for communication between components works best when paired with clear naming conventions.',
			],
			'How to Debug Livewire Applications Efficiently' => [ 
				'Leveraging Laravel\'s built-in logging along with dd() in Livewire methods speeds up debugging.',
				'Utilizing browser dev tools to inspect Livewire requests has saved me countless hours.',
			],
			'Creating Reusable Livewire Components' => [ 
				'I built a set of reusable modal and table components that streamline our project development.',
				'Designing components for flexibility allowed for their effective reuse across different pages.',
			],
		],
		'inertia' => [ 
			'Getting Started with Inertia.js and Laravel' => [ 
				'Inertia bridges Laravel and Vue seamlessly, simplifying the SPA development process.',
				'The starter kits provided by Inertia.js were instrumental in kickstarting our project.',
			],
			'Building Single Page Applications with Inertia.js' => [ 
				'Using Inertia.js, I built a SPA that handles navigation without full page reloads.',
				'It effectively combines server-side routing with a reactive client-side interface.',
			],
			'How to Handle Form Submissions in Inertia.js' => [ 
				'Inertia streamlines form submissions and passes validation errors directly back to the UI.',
				'This approach eliminates the need for redundant API endpoints for form handling.',
			],
			'Optimizing Inertia.js for Better Performance' => [ 
				'Minimizing payload sizes with partial reloads has noticeably improved performance.',
				'I optimized our pages by caching common requests and reducing server load.',
			],
			'Using Inertia.js with Vue or React' => [ 
				'I leveraged Vue with Inertia.js to create interactive, modular UI components.',
				'The React integration was surprisingly smooth, enabling rapid development of dynamic interfaces.',
			],
		],
		'php' => [ 
			'PHP 8 Features You Should Know About' => [ 
				'The JIT compiler in PHP 8 has boosted our performance in compute-intensive tasks.',
				'Named arguments and union types have resulted in more readable and robust code.',
			],
			'How to Secure Your PHP Applications' => [ 
				'Always use prepared statements to defend against SQL injection vulnerabilities.',
				'I recommend libraries that handle encryption and CSRF tokens for comprehensive application security.',
			],
			'Building a Discussion Forum with PHP and MySQL' => [ 
				'Implementing threaded discussions and pagination was key to managing large volumes of posts.',
				'Using password_hash for storing passwords makes authentication secure and straightforward.',
			],
			'Best Practices for PHP Error Handling' => [ 
				'Integrating Monolog with custom exception handlers has made our error logging much more effective.',
				'Implementing try/catch blocks strategically reduces the risk of unhandled exceptions in production.',
			],
			'Exploring Object-Oriented Programming in PHP' => [ 
				'Refactoring legacy code to use namespaces and autoloading has greatly improved our project structure.',
				'Design patterns like Singleton and Factory have streamlined our application architecture.',
			],
		],
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
			$i = 1;
			foreach ( $this->discussionTitles[ $topic ] as $key => $value ) {
				$discussion = Discussion::create( [ 
					'user_id' => User::inRandomOrder()->first()->id,
					'topic_id' => $topicModel->id,
					'title' => $key,
					'slug' => fake()->slug(),
					'created_at' => now()->subYear()->addDays( $i ),
					'updated_at' => now()->subYear()->addDays( $i ),
				] );
				$i++;
				$k = 1;
				foreach ( $value as $key => $post ) {
					Post::create( [ 
						'user_id' => User::inRandomOrder()->first()->id,
						'discussion_id' => $discussion->id,
						// 'parent_id' =,
						'body' => $post,
					] );
				}
			}

			// collect( $this->discussionTitles[ $topic ] )->each( function ($title, $index) use ($topicModel) {
			// 	Discussion::create( [
			// 		'user_id' => User::inRandomOrder()->first()->id,
			// 		'topic_id' => $topicModel->id,
			// 		'title' => $title,
			// 		'slug' => fake()->slug(),
			// 		'created_at' => now()->subYear()->addDays( $index ),
			// 		'updated_at' => now()->subYear()->addDays( $index ),
			// 	] );
			// } );
		} );
	}
}
