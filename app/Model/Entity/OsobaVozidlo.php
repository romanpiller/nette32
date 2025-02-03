<?php declare(strict_types=1);

namespace App\Model\Entity;

/**
 * Class OsobaVozidlo
 *
 * @author Roman Piller
 */
final class OsobaVozidlo
{
  /** @var string column osoba_id */
  public const OSOBA_ID = 'osoba_id';

  /** @var string column vozidlo_id */
  public const VOZIDLO_ID = 'vozidlo_id';

  /** @var int osobaId */
  private int $osobaId;

  /** @var int vozidloId */
  private int $vozidloId;

  /**
   * Constructor
   *
   * @param array<string, int> $data
   * @return void
   */
  public function __construct(array $data)
  {
    $this->osobaId = $data[self::OSOBA_ID];
    $this->vozidloId = $data[self::VOZIDLO_ID];
  }

  /**
   * Konvert objectu na pole
   *
   * @return array<string, int>
   */
  public function toArray(): array
  {
    return [
      self::OSOBA_ID => $this->osobaId,
      self::VOZIDLO_ID => $this->vozidloId,
    ];
  }

  /**
   * Getter osobaId
   *
   * @return int
   */
  public function getOsobaId(): int
  {
    return $this->osobaId;
  }

  /**
   * Getter vozidloId
   *
   * @return int
   */
  public function getVozidloId(): int
  {
    return $this->vozidloId;
  }
}
