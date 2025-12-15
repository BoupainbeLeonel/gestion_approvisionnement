<?php

namespace App\DataFixtures;

use App\Entity\Approvisionnement;
use App\Entity\Article;
use App\Entity\Fournisseur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // 1. Création de deux Fournisseurs
        $fournisseur1 = new Fournisseur();
        $fournisseur1->setNom("Tech Solutions");
        $fournisseur1->setEmail("contact@techsolutions.com");
        $fournisseur1->setTelephone("770000001");
        $manager->persist($fournisseur1);

        $fournisseur2 = new Fournisseur();
        $fournisseur2->setNom("Bureau Pro");
        $fournisseur2->setEmail("info@bureaupro.sn");
        $fournisseur2->setTelephone("770000002");
        $manager->persist($fournisseur2);

        // 2. Création de 5 Articles
        $articles = []; // Tableau pour stocker les articles créés
        for ($i = 1; $i <= 5; $i++) {
            $article = new Article();
            $article->setLibelle("Article n°" . $i);
            $article->setPrixUnitaire(1000 * $i);
            $article->setStock(10 + $i);
            $manager->persist($article);
            
            $articles[] = $article; // On garde l'article en mémoire pour l'utiliser plus bas
        }

        // 3. Création d'une commande d'Approvisionnement
        $approvisionnement = new Approvisionnement();
        $approvisionnement->setReference("CMD-2023-001");
        $approvisionnement->setDate(new \DateTime());
        $approvisionnement->setMontantTotal(15000);
        $approvisionnement->setStatut("En attente");
        
        // RELATIONS :
        // On dit que cette commande vient du fournisseur 1
        $approvisionnement->setFournisseur($fournisseur1);
        
        // On ajoute les deux premiers articles créés à cette commande
        $approvisionnement->addArticle($articles[0]);
        $approvisionnement->addArticle($articles[1]);

        $manager->persist($approvisionnement);

        // 4. Envoi final dans la base de données
        $manager->flush();
    }
}