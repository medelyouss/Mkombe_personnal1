<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220815144918 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product_category DROP FOREIGN KEY FK_CDFC735612469DE2');
        $this->addSql('ALTER TABLE product_type_product DROP FOREIGN KEY FK_76CF493314959723');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE product_type');
        $this->addSql('DROP TABLE product_type_product');
        $this->addSql('ALTER TABLE product_category DROP FOREIGN KEY FK_CDFC73564584665A');
        $this->addSql('DROP INDEX IDX_CDFC73564584665A ON product_category');
        $this->addSql('DROP INDEX IDX_CDFC735612469DE2 ON product_category');
        $this->addSql('ALTER TABLE product_category ADD id INT AUTO_INCREMENT NOT NULL, ADD designation VARCHAR(255) NOT NULL, DROP product_id, DROP category_id, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE product_souscategory ADD CONSTRAINT FK_DCA9A29A12469DE2 FOREIGN KEY (category_id) REFERENCES product_category (id)');
        $this->addSql('ALTER TABLE product_souscategory_product ADD CONSTRAINT FK_BB605DD0A5FE3DED FOREIGN KEY (product_souscategory_id) REFERENCES product_souscategory (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_souscategory_product ADD CONSTRAINT FK_BB605DD04584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE product_type (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE product_type_product (product_type_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_76CF493314959723 (product_type_id), INDEX IDX_76CF49334584665A (product_id), PRIMARY KEY(product_type_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE product_type_product ADD CONSTRAINT FK_76CF493314959723 FOREIGN KEY (product_type_id) REFERENCES product_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_type_product ADD CONSTRAINT FK_76CF49334584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_category MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE product_category DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE product_category ADD product_id INT NOT NULL, ADD category_id INT NOT NULL, DROP id, DROP designation');
        $this->addSql('ALTER TABLE product_category ADD CONSTRAINT FK_CDFC735612469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_category ADD CONSTRAINT FK_CDFC73564584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_CDFC73564584665A ON product_category (product_id)');
        $this->addSql('CREATE INDEX IDX_CDFC735612469DE2 ON product_category (category_id)');
        $this->addSql('ALTER TABLE product_category ADD PRIMARY KEY (product_id, category_id)');
        $this->addSql('ALTER TABLE product_souscategory DROP FOREIGN KEY FK_DCA9A29A12469DE2');
        $this->addSql('ALTER TABLE product_souscategory_product DROP FOREIGN KEY FK_BB605DD0A5FE3DED');
        $this->addSql('ALTER TABLE product_souscategory_product DROP FOREIGN KEY FK_BB605DD04584665A');
    }
}
