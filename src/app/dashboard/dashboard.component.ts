import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute, Params } from '@angular/router';
import { FormBuilder, FormGroup , Validators } from '@angular/forms';
import {HttpModule, Http,Response} from '@angular/http';
import { DashboardService }    from './dashboard.service';
import {ToasterModule, ToasterService} from 'angular2-toaster';
import { Task } from './person';

declare var jQuery: any;



@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.css'],
providers: [DashboardService,ToasterService]
})

export class DashboardComponent implements OnInit {
  private toasterService: ToasterService;
  SaveTaskForm : FormGroup;
  responseStatus:Object= [];
  tasks = [];
  counter = 0;
  submitted = false;
  task;
  TaskList = [];
  taskBulk = [];

  constructor( private fb: FormBuilder ,toasterService: ToasterService, private router: Router , public _http: Http , private _dashboarddservice: DashboardService)
  {  this.toasterService = toasterService;
	  this.SaveTaskForm = fb.group({
		'taskName' : ['',Validators.required],
		'taskDesc' : ['',Validators.required],
	});

  }


  ngOnInit()
  {
	this.GetTask();
  }

  getData()
  {
    this._dashboarddservice.adduser().subscribe(
      data => {
        if(data.success)
        {
        }
      },
      err => console.log(err)
   );
  }

  SaveTask( value : any )
  {
	this.responseStatus = [];
    if( !this.SaveTaskForm.valid )
    {
      return false;
    }
	console.log(value);
    this.task = new Task(value.taskName,value.taskDesc);
	 this.tasks.push(this.task);
    this._dashboarddservice.SaveTask(JSON.stringify(this.task)).subscribe(
      data => {
	  	this.responseStatus = data;
      this.SaveTaskForm.reset();
        if( data.success)
        {
			this.GetTask();
        }
      },
      err => console.log(err)
   );
  }
  // delete(){
  //   this._dashboarddservice.de
  // }

  GetTask()
  {
    this._dashboarddservice.GetTask().subscribe(
      data => {
        if( data.success)
        {
			this.TaskList = data.data
			console.log(data);
        }
      },
      err => console.log(err)
   );
  }
  isAllChecked()
    {
      return this.TaskList.every(_ => _.state);
    }

    checkAll(ev)
    {
      this.TaskList.forEach(x => x.state = ev.target.checked)
      // var objj = jQuery('.storeChecks');
      // console.log(objj);
    }
    deleteee()
      {
        var thiss = this;
        jQuery('input:checkbox.storeChecks').each(function () {
          if(this.checked)
          {
            var atr = jQuery(this).attr('dd');
            if(atr)
            thiss.taskBulk.push(atr);
          }
          else
          {
            console.log('here');
            var atr = jQuery(this).attr('dd');
            if(atr)
            {
              var idx = thiss.taskBulk.indexOf(atr);
              if(idx != -1)
              {
                thiss.taskBulk.splice(idx,1);
              }
            }
          }

          });

          if(thiss.taskBulk.length == 0)
          {
            thiss.toasterService.pop('error', 'Please select atleast 1 task' ,'' );
          }
          else
          {
            jQuery('#deleteModal2').modal('show');
          }
      }

      bulkDelete()
      {
        var thiss = this;
        jQuery('input:checkbox.storeChecks').each(function () {
          if(this.checked)
          {
            var atr = jQuery(this).attr('dd');
            if(atr)
            thiss.taskBulk.push(atr);
          }
          else
          {
            console.log('here');
            var atr = jQuery(this).attr('dd');
            if(atr)
            {
              var idx = thiss.taskBulk.indexOf(atr);
              if(idx != -1)
              {
                thiss.taskBulk.splice(idx,1);
              }
            }
          }
          });

          if(thiss.taskBulk.length == 0)
          {
            thiss.toasterService.pop('error', 'Please select atleast 1 store' ,'' );
          }

        var value       = {}
        value['id']     = this.taskBulk ;

        value['type']   = 'bulkStores';
        this._dashboarddservice.delete(value).subscribe(
          data => {
            if(data.success)
            {
              this.GetTask();
              jQuery('#deleteModal2').modal('hide');
              this.taskBulk = [];
            }
          },
          err => console.log(err)
        );
      }

}
