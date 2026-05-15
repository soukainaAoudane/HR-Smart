<?php
namespace Database\Seeders;

use App\Models\Competence;
use Illuminate\Database\Seeder;

class CompetenceSeeder extends Seeder
{
    public function run()
    {
        $competences = [
            // Backend
            ['nom' => 'PHP', 'categorie' => 'Backend', 'is_critique' => true],
            ['nom' => 'Laravel', 'categorie' => 'Backend', 'is_critique' => true],
            ['nom' => 'Node.js', 'categorie' => 'Backend', 'is_critique' => false],
            ['nom' => 'Python', 'categorie' => 'Backend', 'is_critique' => false],

            // Frontend
            ['nom' => 'React', 'categorie' => 'Frontend', 'is_critique' => true],
            ['nom' => 'Vue.js', 'categorie' => 'Frontend', 'is_critique' => false],
            ['nom' => 'Alpine.js', 'categorie' => 'Frontend', 'is_critique' => false],
            ['nom' => 'Bootstrap', 'categorie' => 'Frontend', 'is_critique' => true],

            // Base de données
            ['nom' => 'MySQL', 'categorie' => 'Base de données', 'is_critique' => true],
            ['nom' => 'PostgreSQL', 'categorie' => 'Base de données', 'is_critique' => false],
            ['nom' => 'MongoDB', 'categorie' => 'Base de données', 'is_critique' => false],

            // DevOps
            ['nom' => 'Docker', 'categorie' => 'DevOps', 'is_critique' => true],
            ['nom' => 'Git', 'categorie' => 'DevOps', 'is_critique' => true],
            ['nom' => 'CI/CD', 'categorie' => 'DevOps', 'is_critique' => false],

            // Management
            ['nom' => 'Gestion de projet', 'categorie' => 'Management', 'is_critique' => true],
            ['nom' => 'Agile/Scrum', 'categorie' => 'Management', 'is_critique' => false],
            ['nom' => 'Communication', 'categorie' => 'Management', 'is_critique' => true],
        ];

        foreach ($competences as $comp) {
            Competence::create($comp);
        }
    }
}
