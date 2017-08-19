<?php

namespace LivresVoyageurs\Extension;

class LivresVoyageursTwigExtension extends \Twig_Extension
{


    // Création du filtre: accroche à partir du contenu de l'article et le Slug
    public function getFilters()
    {
        return array(
            new \Twig_Filter('accroche', function($text) {

                $string = strip_tags($text);
                //Si la chaine est superieure à 170, je continue/
                if (strlen($string) > 170) {
                //coupe à 170/
                $stringCut = substr($string, 0, 170);

                //on evite de couper un mot/
                $string = substr($stringCut, 0, strrpos($stringCut, ' ')) . '...';
                }

                return $string;
            }),
            new \Twig_Filter('slug', function($text) {

            // replace non letter or digits by -
            $text = preg_replace('~[^\pL\d]+~u', '-', $text);

            // transliterate
            $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

            // remove unwanted characters
            $text = preg_replace('~[^-\w]+~', '', $text);

            // trim
            $text = trim($text, '-');

            // remove duplicate -
            $text = preg_replace('~-+~', '-', $text);

            // lowercase
            $text = strtolower($text);

            if (empty($text)) {
                return 'n-a';
            }

            return $text;

            })
        );
    }
}
