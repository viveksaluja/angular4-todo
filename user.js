var mongoose = require('mongoose');  
var User = new mongoose.Schema({
	taskName: { type: String },
	taskDesc: { type: String }
});

mongoose.model('User', User);  
mongoose.connect('mongodb://localhost/'); 

require('mongoose').model('User');

var mongoose = require('mongoose');
var User = mongoose.model('User');

module.exports = {
  createUsers: function (req, res) {
    var person = req.body;
    new User({ taskName: person.taskName, taskDesc: person.taskDesc })
      .save(function (err) {
        if (err) {
          res.status(504);
          res.json({'error': err});
        } else {
          res.json({'success': 'Task Saved Successfully'});
        }
      });
  },
  seeResults: function (req, res, next) {
	  console.log('in api');
    User.find({}, function (err, docs) {
      if (err) {
        res.status(504);
        res.end(err);
      } else {
        for (var i = 0; i < docs.length; i++) {
         console.log('user:', docs[i].taskName);
        }
		//res.end(JSON.parse(JSON.stringify(docs || null )));
        //res.end(JSON.stringify(docs));
		res.json( {'success': true , 'data': docs } );
      }
    });
  },
  delete: function( req, res, next) {
    console.log(req.params.id);
    User.find({ _id: req.params.id}, function(err) {
      if(err) {
        req.status(504);
        req.end();
        console.log(err);
      }
    }).remove(function (err) {
      console.log(err);
      if (err) {
        res.end(err);            
      } else {
        res.end();
      }
    });
  }
}

