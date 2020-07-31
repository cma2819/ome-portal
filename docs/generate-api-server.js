const { generate } = require('./generate.js');
const { join } = require('path');
const { execSync } = require('child_process');

const run = () => {
    generate(
        join(__dirname, 'api.yaml'),
        'nodejs-server'
    ).then((outputDir) => {
        console.log(`npm install at ${outputDir}`)
        execSync('npm install --production', {
            cwd: outputDir
        });
    });
};

run();