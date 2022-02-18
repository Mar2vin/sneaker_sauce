<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220214141517 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article CHANGE designation designation VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE content content LONGTEXT NOT NULL COLLATE `utf8_unicode_ci`, CHANGE image image VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`');
        $this->addSql('ALTER TABLE category CHANGE designation designation VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE description description LONGTEXT DEFAULT NULL COLLATE `utf8_unicode_ci`, CHANGE image image VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(180) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8_unicode_ci` COMMENT \'(DC2Type:json)\', CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE nom nom VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE prenom prenom VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE username username VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`');
    }
}
