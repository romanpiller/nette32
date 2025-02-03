<?php declare(strict_types=1);

namespace App\Model\Repository;

use App\Model\Entity\OsobaVozidlo;
use Nette\Database\Explorer;
use Nette\Database\Table\ActiveRow;

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
    /** @var int[] $activeRows */
    $activeRows = $this->database->table(self::TABLE)
      ->where(OsobaVozidlo::OSOBA_ID . '  = ?', $osobaId)
      ->fetchPairs(null, OsobaVozidlo::VOZIDLO_ID);
    return $activeRows;
  }
}
