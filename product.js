var mongoose = require('mongoose');
var Product = new mongoose.Schema({
	Proname: { type: String },
	Proprice: { type: String }
});

mongoose.model('Product', Product);
mongoose.connect('mongodb://localhost/');

require('mongoose').model('Product');

var mongoose = require('mongoose');
var Product = mongoose.model('Product');

module.exports = {
  createProducts: function (req, res) {
    var thing = req.body;
    new Product({ Proname: thing.Proname, Proprice: thing.Proprice })
      .save(function (err) {
        if (err) {
          res.status(504);
          res.json({'error': err});
        } else {
          res.json({'success': 'Task Saved Successfully'});
        }
      });
  },

  seeProducts :function (req, res, next) {
    Product.find({}, function (err, docs) {
      if (err) {
        res.status(504);
        res.json({'error': err});
      } else {
        for (var i = 0; i < docs.length; i++) {
         console.log('product:', docs[i].Proname);
        }
		res.json( {'success': true , 'data': docs } );
      }
    });
  },

  delete: function( req, res, next) { console.log('in delete api');
    console.log(req.params.id);
    Product.remove({ _id: req.params.id}, function(err) {
      if(err) {
        req.status(504);
        res.json({'error': err});
      }else{

			  res.json({ 'success': 'Successfully deleted' });
}
		});
  },
	update:function (req, res) {
		var thing = req.body.Proname;
		  var id = req.params.id;
			console.log(req.params.id)
     Product.update({'_id':id},req.body.Proname, function (err) {
        if (err) {
            res.send(err);
        }else{
			      res.json({ message: 'Product updated!' });
					}
        });
    },
sortItems: function(req, res) {
  // var mysort = { Proname: 1 };
  Product.find({},{sort:[ 'Proname', -1]},function(err, docs) {
    if (err) {
				res.send(err);
		}else{
			for (var i = 0; i < docs.length; i++) {
			 console.log('product:', docs[i].Proname);
			}
				res.json({ message: 'Product sorted','data':docs });
				console.log(res)
			}
  });
},

Limit: function(req, res) {
Product.find({},{limit:5, sort:['_id',-1]},function(err, docs) {
	if (err) {
			res.send(err);
	}else{
		for (var i = 0; i < docs.length; i++) {
		 console.log('product:', docs[i].Proname);
		}
			res.json({ message: 'Product sorted','data':docs });
			console.log(res)
		}
  });
},
		findById: function(req, res){
	  var id = req.params.id;
	  Product.findById({'_id':id},function(err, result) {
			if (err) {
					res.send(err);
			}else{
			return res.send(result);
		}
	  });
	},
	findByname: function(req, res){
		var thing = req.body.Proname;
	Product.find(
		{  subject:thing,
      content: thing},function(err, result) {
	if (err) {
			res.send(err);
	}else{
	return res.send(result);
}
})
}
}
