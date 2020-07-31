const wget = require('node-wget');
const { join } = require('path');

console.log('Download swaggger-codegen...');

wget({
  url: 'https://repo1.maven.org/maven2/io/swagger/codegen/v3/swagger-codegen-cli/3.0.21/swagger-codegen-cli-3.0.21.jar',
  dest: join(__dirname, 'swagger-codegen-cli.jar'),
}, () => {
  console.log('Success to download swagger-codegen!');
});
