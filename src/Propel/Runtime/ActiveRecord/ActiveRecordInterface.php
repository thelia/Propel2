<?php

/**
 * MIT License. This file is part of the Propel package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Propel\Runtime\ActiveRecord;

/**
 * Common interface for all Propel ActiveRecord model objects.
 *
 * All generated Base classes implement this interface via the baseObjectMethods template.
 *
 * @author jaugustin
 */
interface ActiveRecordInterface
{
    /**
     * Returns true if the primary key for this object is null.
     */
    public function isPrimaryKeyNull(): bool;

    /**
     * Get the associative array of the virtual columns in this object.
     *
     * @return array<string, mixed>
     */
    public function getVirtualColumns(): array;

    /**
     * Checks the existence of a virtual column in this object.
     */
    public function hasVirtualColumn(string $name): bool;

    /**
     * Get the value of a virtual column in this object.
     *
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getVirtualColumn(string $name): mixed;

    /**
     * Set the value of a virtual column in this object.
     *
     * @return $this
     */
    public function setVirtualColumn(string $name, mixed $value): static;
}
