<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        // 3 articles publiés
        Article::create([
            'user_id'      => 1,
            'category_id'  => 1,
            'title'        => 'Débuter avec Laravel en 2025',
            'content'      => 'Laravel est un framework PHP élégant et puissant. Dans cet article, nous allons explorer les bases de Laravel, depuis l installation jusqu à la création de votre première application. Laravel facilite les tâches courantes utilisées dans la majorité des projets web.',
            'status'       => 'published',
            'published_at' => now(),
        ]);

        Article::create([
            'user_id'      => 1,
            'category_id'  => 2,
            'title'        => 'JavaScript Moderne : ES6 et au-delà',
            'content'      => 'JavaScript a énormément évolué ces dernières années. ES6 a introduit des fonctionnalités révolutionnaires comme les arrow functions, les classes, les modules et les promises. Découvrez comment ces nouvelles fonctionnalités peuvent améliorer votre code.',
            'status'       => 'published',
            'published_at' => now()->subDays(3),
        ]);

        Article::create([
            'user_id'      => 1,
            'category_id'  => 3,
            'title'        => 'Déployer une application Laravel avec Docker',
            'content'      => 'Docker révolutionne la façon dont nous déployons nos applications. Dans ce tutoriel, nous allons voir comment containeriser une application Laravel avec Docker et Docker Compose pour un déploiement simple et reproductible.',
            'status'       => 'published',
            'published_at' => now()->subDays(7),
        ]);

        // 3 brouillons
        Article::create([
            'user_id'      => 1,
            'category_id'  => 1,
            'title'        => 'Les Relations Eloquent expliquées',
            'content'      => 'Eloquent ORM est l une des fonctionnalités les plus puissantes de Laravel. Les relations entre modèles permettent de gérer facilement les associations entre vos tables de base de données.',
            'status'       => 'draft',
            'published_at' => null,
        ]);

        Article::create([
            'user_id'      => 1,
            'category_id'  => 4,
            'title'        => 'Comment décrocher son premier emploi en dev',
            'content'      => 'Se lancer dans une carrière de développeur peut sembler intimidant. Dans cet article, je partage mes conseils et mon expérience pour vous aider à décrocher votre premier poste de développeur web.',
            'status'       => 'draft',
            'published_at' => null,
        ]);

        Article::create([
            'user_id'      => 1,
            'category_id'  => 2,
            'title'        => 'Introduction à Vue.js avec Laravel',
            'content'      => 'Vue.js et Laravel forment un duo parfait pour créer des applications web modernes. Dans ce guide, nous verrons comment intégrer Vue.js dans un projet Laravel existant.',
            'status'       => 'draft',
            'published_at' => null,
        ]);
    }
}