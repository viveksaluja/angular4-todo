// Get dependencies
const express = require('express');

//require mongoose node module
var mongoose = require('mongoose');

//connect to local mongodb database
var db = mongoose.connect('mongodb://127.0.0.1:27017/test');

//attach lister to connected event
mongoose.connection.once('connected', function() {
	console.log("Connected to database")
});

var user 		= require('./user');
var product = require('./product');
var seller 	= require('./seller');
var issues	= require('./issues')
const path 	= require('path');
const http 	= require('http');
const bodyParser = require('body-parser');

// Get our API routes
const api = require('./server/routes/api');

const app = express();

// Parsers for POST data
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: false }));

// Point static path to dist
app.use(express.static(path.join(__dirname, 'dist')));

// Set our api routes
app.use('/api', api);

app.post('/createUsers', user.createUsers);
app.get('/seeResults', user.seeResults);
app.post('/createProducts',product.createProducts);
app.get('/seeProducts',product.seeProducts);
app.delete('/delete/:id',product.delete);
app.put('/update/:id',product.update);
app.get('/findById/:id',product.findById);
app.get('/findByname',product.findByname);
app.post('/CreateSeller', seller.CreateSeller);
app.get('/sortItems',product.sortItems);
app.get('/Limit',product.Limit);
app.post('/createIssues',issues.createIssues);
app.get('/seeIssues',issues.seeIssues);
app.get('/findissues',issues.findissues);
app.get('/findtechniquephp',issues.findtechniquephp);
// Catch all other routes and return the index file
app.get('*', (req, res) => {
  res.sendFile(path.join(__dirname, 'dist/index.html'));
});

/**
 * Get port from environment and store in Express.
 */
const port = process.env.PORT || '2100';
app.set('port', port);

/**
 * Create HTTP server.
 */
const server = http.createServer(app);

/**
 * Listen on provided port, on all network interfaces.
 */
server.listen(port, () => console.log(`API running on localhost:${port}`));
