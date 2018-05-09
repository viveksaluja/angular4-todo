import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { ReactiveFormsModule } from '@angular/forms';

import { AppComponent } from './app.component';
import {ToasterModule, ToasterService} from 'angular2-toaster';
import { RouterModule, Routes } from '@angular/router';
import { HttpModule } from '@angular/http';
import { DashboardComponent } from './dashboard/dashboard.component';
import {NgxPaginationModule} from 'ngx-pagination';
import{ImageUploadModule} from 'angular2-image-upload';
import { TagInputModule } from 'ngx-chips';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';

const appRoutes: Routes = [

  {
    path: '',
    redirectTo: 'dashboard',
    pathMatch: 'full'
  },

{
    path: 'dashboard',
    component: DashboardComponent,
	data: { title: 'Dibcase | Register' }
},
];


@NgModule({
  declarations: [
    AppComponent,
    DashboardComponent,

  ],
  imports: [
    ToasterModule.forRoot(),
    TagInputModule,
    BrowserAnimationsModule,
    BrowserModule,
    NgxPaginationModule,
    FormsModule,
    HttpModule,
    ReactiveFormsModule,
    ImageUploadModule.forRoot(),
	RouterModule.forRoot(appRoutes, { useHash: true })
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
