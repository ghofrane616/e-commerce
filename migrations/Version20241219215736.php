<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Migration pour créer la table "categories".
 */
final class Version20241219215736 extends AbstractMigration
{
    /**
     * Retourne la description de la migration.
     */
    public function getDescription(): string
    {
        return 'Création de la table categories avec id et name';
    }

    /**
     * Applique les changements à la base de données.
     */
    public function up(Schema $schema): void
    {
        // Créer la table "categories"
        $table = $schema->createTable('categories');
        $table->addColumn('id', 'integer', ['autoincrement' => true]); // Colonne "id"
        $table->addColumn('name', 'string', ['length' => 255]); // Colonne "name"
        $table->setPrimaryKey(['id']); // Clé primaire sur "id"
    }

    /**
     * Annule les changements effectués dans la méthode "up".
     */
    public function down(Schema $schema): void
    {
        // Supprimer la table "categories"
        $schema->dropTable('categories');
    }
}
