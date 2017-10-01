import { Component, OnInit } from '@angular/core';

import { Table } from './table';
import { TableService } from './table.service';


@Component({
  selector: 'my-dashboard',
  templateUrl: "./dashboard.component.html"
})
export class DashboardComponent implements OnInit {
  tables: Table[] = [];

  constructor(private tableService: TableService) {}

  ngOnInit(): void {
    this.tableService.getTables()
      .then(tables => this.tables = tables.slice(1, 5));
  }
}
