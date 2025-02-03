<?php declare(strict_types=1);

namespace App\Model\Repository;

use App\Model\Entity\Osoba;
use App\Model\Entity\Vozidlo;
use InvalidArgumentException;
use Nette\Database\Explorer;
use Nette\Database\Table\ActiveRow;

/**
 * Class OsobaRepository
 *
 * @author Roman Piller
 */
final class OsobaRepository
{
  /** @var string table name */
  public const TABLE = 'osoby';

  /**
   * Constructor
   *
   * @param Explorer $database
   * @return void
   */
  public function __construct(private readonly Explorer $database)
  {
  }

  /**
   * Nájde osobu podľa ID
   *
   * @param int $id
   * @return Osoba
   * @throws InvalidArgumentException
   */
  public function findById(int $id): Osoba
  {
    $activeRow =  $this->database->table(self::TABLE)->get($id);
    if($activeRow === null)
    {
      throw new InvalidArgumentException("Osoba {$id} not found.");
    }
    return new Osoba($activeRow->toArray());
  }

  /**
   * Načíta všetky osoby
   *
   * @return Osoba[]
   */
  public function findAll(): array
  {
    $activeRows = $this->database->table(self::TABLE)->fetchAll();
    return array_map(static fn($activeRow) => new Osoba($activeRow->toArray()), $activeRows);
  }

  /**
   * Vlozi zaznam do tabulky
   *
   * @param Osoba $osoba
   * @return Osoba
   * @throws InvalidArgumentException
   */
  public function insert(Osoba $osoba): Osoba
  {
    $activeRow = $this->database->table(self::TABLE)->insert($osoba->toArray());
    if(!$activeRow instanceof ActiveRow)
    {
      throw new InvalidArgumentException("Osoba {$osoba->getId()} cannot insert.");
    }
    return new Osoba($activeRow->toArray());
  }

  /**
   * Aktualizuje zaznam v tabulke
   *
   * @param Osoba $osoba
   * @return bool
   * @throws InvalidArgumentException
   */
  public function update(Osoba $osoba): bool
  {
    return $this->getActiveRow($osoba->getId())->update($osoba->toArray());
  }

  /**
   * Odstráni osobu
   *
   * @param int $id
   * @return void
   * @throws InvalidArgumentException
   */
  public function delete(int $id): void
  {
    $this->getActiveRow($id)->delete();
  }

  /**
   * Ziska active row zaznam podla id
   *
   * @param int $id
   * @return ActiveRow
   * @throws InvalidArgumentException
   */
  private function getActiveRow(int $id): ActiveRow
  {
    $activeRow = $this->database->table(self::TABLE)->get($id);
    if($activeRow === null)
    {
      throw new InvalidArgumentException("Osoba {$id} not found.");
    }
    return $activeRow;
  }
}
