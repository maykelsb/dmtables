import { NgModule }      from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { FormsModule } from '@angular/forms';

import { AppComponent }  from './app.component';

import { TablesComponent } from './tables.component';
import { TableDetailComponent } from './table-detail.component';
//import { TableService } from './table.service';

@NgModule({
  imports: [ 
    BrowserModule,
    FormsModule
   ],
  declarations: [
    AppComponent,
    TableDetailComponent,
    TablesComponent,
    //TableService
   ],
  bootstrap:  [ AppComponent ]
})
export class AppModule { }
