const { exec, execSync } = require('child_process')
const { join } = require('path');
const { mkdirSync, fstat, writeFileSync } = require('fs');

module.exports.generate = async (input, lang) => {
    if (!input || !lang) {
        console.log('Bad arguments provided.');
        return;
    }

    const jarPath = join(__dirname, 'swagger-codegen-cli.jar');
    const outputDir = join(__dirname, 'output', lang);
    mkdirSync(outputDir, {
        recursive: true
    });
    writeFileSync(join(outputDir, '.swagger-codegen-ignore'), '');
    console.log(`Code-generate to ${outputDir}`);
    execSync(`java -jar ${jarPath} generate -i ${input} -l ${lang} -o ${outputDir}`);

    return Promise.resolve(outputDir);
}
