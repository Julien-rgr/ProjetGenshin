<?php
namespace Config;

use Exception;

class Config
{
    private static $param;

    /**
     * Retourne la valeur d’un paramètre de configuration.
     *
     * @param string $nom Nom du paramètre recherché.
     * @param mixed|null $valeurParDefaut Valeur retournée si le paramètre n’existe pas.
     * @return mixed Valeur du paramètre ou valeur par défaut.
     */
    public static function get($nom, $valeurParDefaut = null)
    {
        if (isset(self::getParameter()[$nom])) {
            return self::getParameter()[$nom];
        }
        return $valeurParDefaut;
    }

    private static function getParameter()
    {
        if (self::$param === null) {
            $cheminFichier = "Config/prod.ini";

            if (!file_exists($cheminFichier)) {
                $cheminFichier = "Config/dev.ini";
            }
            if (!file_exists($cheminFichier)) {
                throw new Exception("Aucun fichier de configuration trouvé");
            }

            self::$param = parse_ini_file($cheminFichier);
        }

        return self::$param;
    }
}
