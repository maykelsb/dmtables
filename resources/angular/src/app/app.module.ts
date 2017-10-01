import { NgModule }      from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { FormsModule } from '@angular/forms';
import { RouterModule } from '@angular/router';

import { AppComponent }  from './app.component';

import { TablesComponent } from './tables.component';
import { TableDetailComponent } from './table-detail.component';

import { DashboardComponent } from './dashboard.component';

@NgModule({
  imports: [ 
    BrowserModule,
    FormsModule,
    RouterModule.forRoot([
      { path: 'tables', component: TablesComponent },
      { path: 'table/:id', component: TableDetailComponent },
      { path: 'dashboard', component: DashboardComponent },
      { path: '', redirectTo: '/dashboard', pathMatch: 'full' }
    ])
  ],
  declarations: [
    AppComponent,
    TableDetailComponent,
    TablesComponent,
    DashboardComponent
   ],
  bootstrap:  [ AppComponent ]
})
export class AppModule { }
