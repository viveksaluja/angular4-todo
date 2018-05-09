var mongoose = require('mongoose');
var Seller= new mongoose.Schema({
	Sellername:{type:String}
})

mongoose.model('Seller',Seller);
mongoose.connect('mongodb://localhost/');

require('mongoose').model('Seller');
var mongoose = require('mongoose');
var Seller = mongoose.model('Seller');
module.exports = {
  createSeller: function (req, res) {
    var thing = req.body;
    console.log(thing)
    new Seller({ Sellername: thing.Sellername })
      .save(function (err) {
        if (err) {
          res.status(504);
          res.json({'error': err});
        } else {
          res.json({'success': 'Seller Saved Successfully'});
        }
      });
  },
}
