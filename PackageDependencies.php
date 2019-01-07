<?php

require_once('DefinitionsException.php');
require_once('ValidateDefinitions.php');

class PackageDependencies extends ValidateDefinitions
{
    /**
     * @param array $packages
     * @param string $packageName
     * @return array
     */
    public function getAllPackageDependencies(array $packages, string $packageName): array
    {
        $this->validatePackageDefinitions($packages);
        $ArrayPackages = $this->getAllArrayOfDependencies($packages, $packageName);
        $ArrayPackages = $this->convertMassArrayForOne($ArrayPackages);

        return $ArrayPackages;
    }

    /**
     * @param array $packages
     * @param string $packageName
     * @return array
     */
    private function getAllArrayOfDependencies(array $packages, string $packageName): array
    {
        $fullArrayOfAllNeededPackages = [$packageName];
        if (isset($packages[$packageName]['dependencies'])){
        foreach (@$packages[$packageName]['dependencies'] as $key => $dependencies) {
            if (count((array)$dependencies) !== 0) {
                $fullArrayOfAllNeededPackages[] = $this->getAllArrayOfDependencies($packages, $dependencies);
            }
        }
        }

        return $fullArrayOfAllNeededPackages;
    }

    /**
     * @param array $multipleArrayForFormat
     * @return array
     */
    private function convertMassArrayForOne(array $multipleArrayForFormat): array
    {
        $iterator = new RecursiveIteratorIterator(new RecursiveArrayIterator($multipleArrayForFormat));
        $simpleArray = iterator_to_array($iterator, false);
        $reverseArray = array_reverse($simpleArray);
        $finalDependencies = array_unique($reverseArray);

        return $finalDependencies;
    }


}