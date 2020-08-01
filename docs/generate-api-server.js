const { generate } = require('./generate.js');
const { join } = require('path');
const { execSync } = require('child_process');
const { copyFileSync } = require('fs');

const run = () => {
    generate(
        join(__dirname, 'api.yaml'),
        'nodejs-server'
    ).then((outputDir) => {
        console.log(`npm install at ${outputDir}`);
        execSync('npm install --production', {
            cwd: outputDir
        });

        console.log('Copy alternative index.js to output');
        copyFileSync(join(__dirname, 'node_index.js'), join(outputDir, 'index.js'));
    });
};

run();
