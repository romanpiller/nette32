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
  public const TABLE = 'osoba_vozidlo';

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
   * @return array
   */
  public function findVozidlaByOsoba(int $osobaId): array
  {
    $activeRows = $this->database->table(self::TABLE)
      ->where(OsobaVozidlo::OSOBA_ID, $osobaId)->fetchAll();
    //TODO: ak problem ze activeRows nie nie pole tak iterator_to_array($activeRows)
    return array_map(static fn($activeRow) => new OsobaVozidlo($activeRow), $activeRows);
  }

  /**
   * Sparuje vozidlo a osobu
   *
   * @param int $osobaId
   * @param int $vozidloId
   */
  public function assignVozidlo(int $osobaId, int $vozidloId): void
  {
    //TODO: tu ak zadas zle id hodi to mysql vynimku
    $this->database->table(self::TABLE)->insert([
      OsobaVozidlo::OSOBA_ID => $osobaId,
      OsobaVozidlo::VOZIDLO_ID => $vozidloId,
    ]);
  }

  /**
   * Odparuje osobu a vozidlo
   *
   * @param int $osobaId
   * @param int $vozidloId
   * @return bool
   */
  public function removeVozidlo(int $osobaId, int $vozidloId): bool
  {
    return (bool) $this->database->table(self::TABLE)
      ->where(OsobaVozidlo::OSOBA_ID, $osobaId)
      ->where(OsobaVozidlo::VOZIDLO_ID, $vozidloId)
      ->delete();
  }


}
