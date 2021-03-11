<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200525111432 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE tag_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE users_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE reponse_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE question_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE tag (id INT NOT NULL, labeltag VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE tag_question (tag_id INT NOT NULL, question_id INT NOT NULL, PRIMARY KEY(tag_id, question_id))');
        $this->addSql('CREATE INDEX IDX_80C63295BAD26311 ON tag_question (tag_id)');
        $this->addSql('CREATE INDEX IDX_80C632951E27F6BF ON tag_question (question_id)');
        $this->addSql('CREATE TABLE users (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, pseudo VARCHAR(255) NOT NULL, note INT DEFAULT 1 NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9E7927C74 ON users (email)');
        $this->addSql('CREATE TABLE reponse (id INT NOT NULL, user_id INT NOT NULL, question_id INT NOT NULL, bodyreponse TEXT NOT NULL, datereponse TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, notereponse INT NOT NULL, valide BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5FB6DEC7A76ED395 ON reponse (user_id)');
        $this->addSql('CREATE INDEX IDX_5FB6DEC71E27F6BF ON reponse (question_id)');
        $this->addSql('CREATE TABLE question (id INT NOT NULL, user_id INT NOT NULL, titlequestion TEXT NOT NULL, bodyquestion TEXT NOT NULL, datequestion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, notequestion INT DEFAULT 10 NOT NULL, resolve BOOLEAN NOT NULL, vu INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B6F7494EA76ED395 ON question (user_id)');
        $this->addSql('CREATE TABLE notequestion (iduser_id INT NOT NULL, idquestion_id INT NOT NULL, note INT NOT NULL, PRIMARY KEY(iduser_id, idquestion_id))');
        $this->addSql('CREATE INDEX IDX_43196CA9786A81FB ON notequestion (iduser_id)');
        $this->addSql('CREATE INDEX IDX_43196CA9D8E68610 ON notequestion (idquestion_id)');
        $this->addSql('CREATE TABLE notereponse (iduser_id INT NOT NULL, idreponse_id INT NOT NULL, note INT NOT NULL, PRIMARY KEY(iduser_id, idreponse_id))');
        $this->addSql('CREATE INDEX IDX_BE576E90786A81FB ON notereponse (iduser_id)');
        $this->addSql('CREATE INDEX IDX_BE576E902B1A6B8 ON notereponse (idreponse_id)');
        $this->addSql('ALTER TABLE tag_question ADD CONSTRAINT FK_80C63295BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tag_question ADD CONSTRAINT FK_80C632951E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC7A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC71E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494EA76ED395 FOREIGN KEY (user_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE notequestion ADD CONSTRAINT FK_43196CA9786A81FB FOREIGN KEY (iduser_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE notequestion ADD CONSTRAINT FK_43196CA9D8E68610 FOREIGN KEY (idquestion_id) REFERENCES question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE notereponse ADD CONSTRAINT FK_BE576E90786A81FB FOREIGN KEY (iduser_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE notereponse ADD CONSTRAINT FK_BE576E902B1A6B8 FOREIGN KEY (idreponse_id) REFERENCES reponse (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE tag_question DROP CONSTRAINT FK_80C63295BAD26311');
        $this->addSql('ALTER TABLE reponse DROP CONSTRAINT FK_5FB6DEC7A76ED395');
        $this->addSql('ALTER TABLE question DROP CONSTRAINT FK_B6F7494EA76ED395');
        $this->addSql('ALTER TABLE notequestion DROP CONSTRAINT FK_43196CA9786A81FB');
        $this->addSql('ALTER TABLE notereponse DROP CONSTRAINT FK_BE576E90786A81FB');
        $this->addSql('ALTER TABLE notereponse DROP CONSTRAINT FK_BE576E902B1A6B8');
        $this->addSql('ALTER TABLE tag_question DROP CONSTRAINT FK_80C632951E27F6BF');
        $this->addSql('ALTER TABLE reponse DROP CONSTRAINT FK_5FB6DEC71E27F6BF');
        $this->addSql('ALTER TABLE notequestion DROP CONSTRAINT FK_43196CA9D8E68610');
        $this->addSql('DROP SEQUENCE tag_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE users_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE reponse_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE question_id_seq CASCADE');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE tag_question');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE reponse');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE notequestion');
        $this->addSql('DROP TABLE notereponse');
    }
}
