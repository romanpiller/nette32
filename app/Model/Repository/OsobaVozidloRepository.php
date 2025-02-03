<?php declare(strict_types=1);

namespace App\Model\Repository;

use App\Model\Entity\OsobaVozidlo;
use Nette\Database\Explorer;

/**
 * Class OsobaVozidloRepository
 *
 * @author Roman Piller
 */
final class OsobaVozidloRepository
{
  /** @var string table name */
  public const TABLE = 'osoba_vozidla';

  /**
   * Construct
   *
   * @param Explorer $database
   * @return void
   */
  public function __construct(private readonly Explorer $database)
  {
  }

  /**
   * Vyhlada vozidlo podla id
   *
   * @param int $osobaId
   * @return int[]
   */
  public function findIdVozidlaByOsobaId(int $osobaId): array
  {
    $activeRows = $this->database->table(self::TABLE)
      ->where(OsobaVozidlo::OSOBA_ID . '  = ?', $osobaId)
      ->fetchAll();
    return array_map(
      static function($activeRow){
        /** @var array{id: int} $activeRow */
        $activeRow =   $activeRow[OsobaVozidlo::ID];
        /** @var int $id */
        $id = $activeRow['id'];
        return $id;
    }, $activeRows);
  }
}
