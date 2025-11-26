<?php
namespace Data\Logs;

class Logger
{
    private string $logDir;

    /**
     * @param string $logDir Chemin du dossier où enregistrer les fichiers de logs
     */
    public function __construct(string $logDir = __DIR__ . '/../logs/')
    {
        $this->logDir = $logDir;

        if (!is_dir($this->logDir)) {
            mkdir($this->logDir, 0777, true);
        }
    }

    /**
     * Ajoute une ligne dans le fichier de log du mois courant.
     *
     * @param string $message Message à écrire dans les logs
     * @return void
     */
    public function log(string $message): void
    {
        $fileName = "MIHOYO_" . date("m_Y") . ".log";
        $filePath = $this->logDir . $fileName;

        $timestamp = date("[d/m/Y - H:i:s]");

        file_put_contents($filePath, "$timestamp $message\n", FILE_APPEND);
    }
}
