<?php declare(strict_types=1);

namespace App\Model\Service;

use App\Model\Entity\Osoba;
use App\Model\Entity\Vozidlo;
use App\Model\Repository\OsobaRepository;
use App\Model\Repository\OsobaVozidloRepository;
use App\Model\Repository\VozidloRepository;
use InvalidArgumentException;

/**
 * Class OsobaService
 *
 * @author Roman Piller
 */
final class OsobaService
{
  /**
   * Constructor
   *
   * @param OsobaRepository        $osobaRepository
   * @return void
   */
  public function __construct(
    private readonly OsobaRepository $osobaRepository,
  )
  {
  }

  /**
   * Ziskas osobu podla osoba Id
   *
   * @param int $osobaId
   * @return Osoba
   * @throws InvalidArgumentException
   */
  public function getOsoba(int $osobaId): Osoba
  {
    return $this->osobaRepository->findById($osobaId);
  }

  /**
   * Rename osoba object
   *
   * @param int    $osobaId
   * @param string $newName
   * @return void
   * @throws InvalidArgumentException
   */
  public function renameOsoba(int $osobaId, string $newName): void
  {
    $osoba = $this->osobaRepository->findById($osobaId);
    $osoba->setName($newName);
    $this->osobaRepository->update($osoba);
  }
}
