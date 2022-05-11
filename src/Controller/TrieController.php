<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TrieController extends AbstractController
{

    private int $loop = 0; // nombre de boucles

    #[Route('/', name: 'bubble_sort')]
    public function index(): Response
    {
        $arrayBubbleSort = array(12, 25, 3, 1, 42, 13, 132, 75, 306, 412, 8); //Tableau à trier
        $arrayBeforeSort = $arrayBubbleSort; //Tableau d'origine
        $n = count($arrayBubbleSort); //Nombre de chiffres dans le tableau
        $start = microtime(true); //Temps de départ

        for ($i = 0; $i < $n; $i++) { //Pour i allant 0 à n-1
            for ($j = 0; $j < $n - $i - 1; $j++) { //Pour j allant 0 à n-1
                if ($arrayBubbleSort[$j] > $arrayBubbleSort[$j + 1]) { //Si la valeur de j > j+1
                    $temp = $arrayBubbleSort[$j]; //On va permuter les valeurs de j et j+1
                    $arrayBubbleSort[$j] = $arrayBubbleSort[$j + 1]; //On va permuter les valeurs de j et j+1
                    $arrayBubbleSort[$j + 1] = $temp; //On va permuter les valeurs de j et j+1
                }
                $this->loop++; //On incrémente le nombre de boucles
            }
        }
        $end = microtime(true); //Temps de fin
        $timeBubbleSort = ($end - $start) * 1000; //Temps d'exécution

        return $this->render('trie/index.html.twig', [
            'arrayBeforeSort' => $arrayBeforeSort,
            'bubble_sort' => $arrayBubbleSort,
            'time_bubble_sort' => $timeBubbleSort,
            'count_bubble_sort' => $this->loop,
        ]);
    }


    #[Route('/fusion_sort', name: 'fusion_sort')]
    public function fusionSort(): Response
    {
        $array = array(1, 5, 3, 7, 2); //Tableau à trier
        $arrayBeforeSort = $array; //Tableau d'origine
        $start = microtime(true);

        if( count($array) <= 1 ){ //Si le tableau est vide ou contient un seul élément
            return $array;  //On retourne le tableau
        }

        $left =  array(); //Tableau gauche
        $right = array(); //Tableau droit

        $middle = (int) ( count($array)/2 ); //On divise le tableau en deux parties

        for( $i=0; $i < $middle; $i++ ){ //Pour i allant 0 à middle-1
            $left[] = $array[$i]; //On ajoute à gauche
        }
        for( $i = $middle; $i < count($array); $i++ ){ //Pour i allant middle à n-1
            $right[] = $array[$i]; //On ajoute les éléments de la deuxième partie du tableau à droite
        }

        $this->fusionSort($left); //On récursivement trie la liste gauche
        $this->fusionSort($right); //On récursivement trie la liste droite

        $this->merge($left, $right); //On fusionne les deux listes


        $end = microtime(true); //Temps de fin
        $timefusionSort = ($end - $start) * 1000; //Temps d'exécution

        return $this->render('trie/fussionsort.html.twig', [
            'arrayBeforeSort' => $arrayBeforeSort,
            'fusion_sort' => $array,
            'time_fusion_sort' => $timefusionSort,
            'count_fusion_sort' => $this->loop,
        ]);
    }

    private function merge($left, $right)
    {
        $arraySort = array(); //Tableau de résultat

        while(count($left) > 0 || count($right) > 0){
            if(count($left) > 0 && count($right) > 0){
                if($left[0] <= $right[0]){
                    $arraySort[] = array_shift($left);
                } else {
                    $arraySort[] = array_shift($right);
                }
            } elseif (count($left) > 0){
                $arraySort[] = array_shift($left);
            } elseif (count($right) > 0){
                $arraySort[] = array_shift($right);
            }
        }


        dd($left , $right);


    }


    #[Route('/tree_sort', name: 'tree_sort')]
    public function treeSort(): Response
    {

        //        Premiere tentative de tree sort

//        $arrayTreeSort = array(12, 25, 3, 1, 42, 45, 132, 75, 306, 412); //Tableau à trier
//        $arrayBeforeSort = $arrayTreeSort; //Tableau d'origine
//        $arrayCount = count($arrayTreeSort); //Nombre de chiffres dans le tableau
//        $middle = floor($arrayCount / 2); //Nombre de chiffres dans le tableau
//        $left = []; //Tableau gauche
//        $right = []; //Tableau droit
//        $newTable = []; //Tableau final
//
//        $root = $arrayTreeSort[$middle]; //On récupère la valeur du milieu du tableau
//
//
//
//        for ($i = 0; $i < $arrayCount; $i++) { //Pour i allant 0 à n-1
//            if ($arrayTreeSort[$i] < $root) { //Si la valeur de i < root
//                $left[] = $arrayTreeSort[$i]; //On ajoute la valeur de i dans le tableau gauche
//                if (count($left) > 1) { //Si le nombre de valeurs dans le tableau gauche est supérieur à 1
//                    $countLeft = count($left); //On récupère le nombre de valeurs dans le tableau gauche
//                    $middleleft = floor($countLeft / 2); //Nombre de chiffres dans le tableau
//                    $rootleft = $left[$middleleft]; //On récupère la valeur du milieu du tableau
//                    dd($rootleft);
//                    for ($j = 0; $j < $countLeft - 1; $j++) { //Pour j allant 0 à n-1
//                        if ($left[$j] < $rootleft) { //Si la valeur de j < root
//                            $temp[] = $left[$j]; //On va permuter les valeurs de j et j+1
//                            $left[$j] = array_merge($temp);
//                            unset($temp); //On supprime le tableau temporaire
//                        }
//
//                    }
//
//                }
//            } elseif ($arrayTreeSort[$i] > $root) { //Sinon
//                $right[] = $arrayTreeSort[$i]; //On ajoute la valeur de i dans le tableau droit
//                if (count($right) >= 2) { //Si le nombre de valeurs dans le tableau droit est supérieur ou égal à 2
//
//                }
//            }
//        }
//
//        $newTable = array_merge($left, $right); //On fusionne les deux tableaux
//
//        dd($left);


// 2eme tentative de Tree sort

//$array = (array(12, array (63, 34), array (22, 12))); //Tableau à trier
//        $arrayBeforeSort = $array; //Tableau d'origine
//        $n = count($array); //Nombre de chiffres dans le tableau
//        $start = microtime(true); //Temps de départ
//
////        dd($array[1][0]);
//
//       for ($i = 1; $i < $n; $i++) { //Pour i allant 0 à n-1
//           for ($j = 0; $j < $n - $i - 1; $j++) { //Pour j allant 0 à n-1
//               if ($array[$i][$i] > $array[$i+1][$j]) { //Si la valeur de i > i+1
//                   $temp = $array[$i][$j]; //On va permuter les valeurs de i et i+1
//                   $array[$i][$j] = $array[$i][$j + 1]; //On va permuter les valeurs de i et i+1
//                   $array[$i][$j + 1] = $temp; //On va permuter les valeurs de i et i+1
//               }
//           }
//       }
//
//
//        dd($array);


        return $this->render('trie/treesort.html.twig', [
            'controller_name' => 'TrieController',
        ]);
    }


}



