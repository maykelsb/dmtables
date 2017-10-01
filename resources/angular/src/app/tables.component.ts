import { Component, OnInit } from '@angular/core';

import { Table } from './table';
import { TableService } from './table.service';

@Component({
  selector: 'my-tables',
  template: `
<h2>Minhas tabelas</h2>
<ul class="tables">
  <li *ngFor="let table of tables"
      [class.selected]="table === selectedTable"
      (click)="onSelect(table)">
    <span class="badge">{{table.id}}</span> {{table.name}}
  </li>
</ul>
<table-detail [table]="selectedTable"></table-detail>
  `,
  styles: [`
  .selected {
    background-color: #CFD8DC !important;
    color: white;
  }
  .tables {
    margin: 0 0 2em 0;
    list-style-type: none;
    padding: 0;
    width: 15em;
  }
  .tables li {
    cursor: pointer;
    position: relative;
    left: 0;
    background-color: #EEE;
    margin: .5em;
    padding: .3em 0;
    height: 1.6em;
    border-radius: 4px;
  }
  .tables li.selected:hover {
    background-color: #BBD8DC !important;
    color: white;
  }
  .tables li:hover {
    color: #607D8B;
    background-color: #DDD;
    left: .1em;
  }
  .tables .text {
    position: relative;
    top: -3px;
  }
  .tables .badge {
    display: inline-block;
    font-size: small;
    color: white;
    padding: 0.8em 0.7em 0 0.7em;
    background-color: #607D8B;
    line-height: 1em;
    position: relative;
    left: -1px;
    top: -4px;
    height: 1.8em;
    margin-right: .8em;
    border-radius: 4px 0 0 4px;
  }
  `]
})

export class TablesComponent implements OnInit {
  title = 'RPGtables';
  tables: Table[];
  selectedTable: Table;

  constructor(private tableService: TableService) {
  }

  ngOnInit(): void {
    this.getTables();
  }

  onSelect(table: Table): void {
    this.selectedTable = table;
  }

  getTables(): void {
    this.tableService.getTablesSlowly().then(tables => this.tables = tables);
  }
}
