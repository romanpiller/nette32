<?php declare(strict_types=1);

namespace App\Model\Repository;

use App\Model\Entity\Osoba;
use App\Model\Entity\Vozidlo;
use InvalidArgumentException;
use Nette\Database\Explorer;
use Nette\Database\Table\ActiveRow;

/**
 * Class VozidloRepository
 *
 * @author Roman Piller
 */
final class VozidloRepository
{
  /** @var string table name */
  public const TABLE = 'vozidla';

  /**
   * Construktor
   *
   * @param Explorer $database
   * @return void
   */
  public function __construct(private readonly Explorer $database)
  {
  }

  /**
   * Nájde vozidlo podľa ID
   *
   * @param int $id
   * @return Vozidlo
   * @throws InvalidArgumentException
   */
  public function findById(int $id): Vozidlo
  {
    $activeRow = $this->database->table(self::TABLE)->get($id);

    if($activeRow === null)
    {
      throw new InvalidArgumentException("Vozidlo {$id} not found.");
    }
    return new Vozidlo($activeRow->toArray());
  }

  /**
   * Nacita vsetky vozidla
   *
   * @return Vozidlo[]
   */
  public function findAll(): array
  {
    $activeRows = $this->database->table(self::TABLE)->fetchAll();
    return array_map(static fn($activeRow) => new Vozidlo($activeRow->toArray()), $activeRows);
  }

  /**
   * Vlozi zaznam do tabulky
   *
   * @param Vozidlo $vozidlo
   * @return Vozidlo
   * @throws InvalidArgumentException
   */
  public function insert(Vozidlo $vozidlo): Vozidlo
  {
    $activeRow = $this->database->table(self::TABLE)->insert($vozidlo->toArray());
    if(!$activeRow instanceof ActiveRow)
    {
      throw new InvalidArgumentException("Vozidlo {$vozidlo->getId()} cannot insert.");
    }
    return new Vozidlo($activeRow->toArray());
  }

  /**
   * Aktualizuje zaznam v tabulke
   *
   * @param Vozidlo $vozidlo
   * @return bool
   * @throws InvalidArgumentException
   */
  public function update(Vozidlo $vozidlo): bool
  {
    return $this->getActiveRow($vozidlo->getId())->update($vozidlo->toArray());
  }

  /**
   * Odstráni vozidlo
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
   * Ziska active row zoznam podla id
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
      throw new InvalidArgumentException("Vozidlo {$id} not found.");
    }
    return $activeRow;
  }
}
