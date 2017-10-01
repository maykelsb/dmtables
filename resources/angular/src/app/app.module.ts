import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { FormsModule } from '@angular/forms';

import { AppComponent }  from './app.component';
import { AppRoutingModule } from './app-routing.module';

import { TablesComponent } from './tables.component';
import { TableDetailComponent } from './table-detail.component';

import { DashboardComponent } from './dashboard.component';

import { TableService } from './table.service';


@NgModule({
  imports: [ 
    BrowserModule,
    FormsModule,
    AppRoutingModule
  ],
  declarations: [
    AppComponent,
    TableDetailComponent,
    TablesComponent,
    DashboardComponent
  ],
  providers: [ TableService ],
  bootstrap:  [ AppComponent ]
})
export class AppModule { }
