<?php

namespace Scripts;

use ErrorException;
use Nette\PhpGenerator\PhpFile;
use Nette\PhpGenerator\PhpNamespace;
use RuntimeException;

class GenerateDomainUseCase
{
    public function __invoke(
        string $rootPath,
        string $domain,
        string $name
    )
    {
        $domainNamespace = ucfirst($domain);
        $useCaseName = ucfirst($name);
        $useCaseDir = "{$rootPath}/domain/{$domainNamespace}/Interfaces/UseCases/{$useCaseName}";

        try {
            mkdir($useCaseDir, 0777, true);
        } catch (ErrorException $e) {
            throw new RuntimeException('UseCase is already exists!');
        }

        $namespace = "Ome\\{$domainNamespace}\\Interfaces\\UseCases\\{$useCaseName}";
        $requestName = "{$namespace}\\{$useCaseName}Request";
        $responseName = "{$namespace}\\{$useCaseName}Request";

        $useCaseFile = new PhpFile;
        $useCaseInterface = $useCaseFile->addNamespace($namespace);
        $useCaseInterfacePath = "{$useCaseDir}/{$useCaseName}UseCase.php";
        $this->makeUseCaseInterface($useCaseInterface, $useCaseName, $requestName, $responseName);
        file_put_contents($useCaseInterfacePath, $useCaseFile);

        $requestFile = new PhpFile;
        $useCaseRequest = $requestFile->addNamespace($namespace);
        $useCaseRequestPath = "{$useCaseDir}/{$useCaseName}Request.php";
        $this->makeUseCaseRequest($useCaseRequest, $useCaseName);
        file_put_contents($useCaseRequestPath, $requestFile);

        $responseFile = new PhpFile;
        $useCaseResponse = $responseFile->addNamespace($namespace);
        $useCaseResponsePath = "{$useCaseDir}/{$useCaseName}Response.php";
        $this->makeUseCaseResponse($useCaseResponse, $useCaseName);
        file_put_contents($useCaseResponsePath, $responseFile);
    }

    protected function makeUseCaseInterface(
        PhpNamespace $namespace,
        string $useCaseName,
        string $requestName,
        string $responseName
    ): PhpNamespace
    {
        $interface = $namespace->addInterface("{$useCaseName}UseCase");
        $comment = implode(' ',  preg_split('/(?=[A-Z])/', $useCaseName, -1, PREG_SPLIT_NO_EMPTY)) . '.';
        $interface->addComment($comment);
        $interact = $interface->addMethod('interact')
            ->addComment($comment)
            ->setReturnType($responseName);
        $interact->addParameter('request')->setType($requestName);

        return $namespace;
    }

    protected function makeUseCaseRequest(
        PhpNamespace $namespace,
        string $useCaseName
    ): PhpNamespace
    {
        $request = $namespace->addClass("{$useCaseName}Request");
        $comment = "Request object for {$useCaseName}.";
        $request->addComment($comment);

        return $namespace;
    }

    protected function makeUseCaseResponse(
        PhpNamespace $namespace,
        string $useCaseName
    ): PhpNamespace
    {
        $request = $namespace->addClass("{$useCaseName}Response");
        $comment = "Response object for {$useCaseName}.";
        $request->addComment($comment);

        return $namespace;
    }
}
