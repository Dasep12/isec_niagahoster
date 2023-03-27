<div class="row mb-3 g-3">
            <div class="col-lg-12 col-xxl-9">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-4 border-lg-end border-bottom border-lg-0 pb-3 pb-lg-0">
                      <div class="d-flex flex-between-center mb-3">
                        <div class="d-flex align-items-center">
                          <div class="icon-item icon-item-sm bg-soft-primary shadow-none me-2 bg-soft-primary"><span class="fs--2 fas fa-user text-info"></span></div>
                          <h6 class="mb-0">Anggota</h6>
                        </div>
                        <div class="dropdown font-sans-serif btn-reveal-trigger"><button class="btn btn-link text-600 btn-sm dropdown-toggle dropdown-caret-none btn-reveal" type="button" id="dropdown-new-contact" data-bs-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--2"></span></button>
                          <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="dropdown-new-contact"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                            <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                          </div>
                        </div>
                      </div>
                      <div class="d-flex">
                        <div class="d-flex">
                          <p class="font-sans-serif lh-1 mb-1 fs-4 pe-2"><?= $anggota?></p>
                        </div>
                        <div class="echart-crm-statistics w-100 ms-2" data-echart-responsive="true" data-echarts='{"series":[{"type":"line","data":[220,230,150,175,200,170,70,160],"color":"#2c7be5","areaStyle":{"color":{"colorStops":[{"offset":0,"color":"#2c7be53A"},{"offset":1,"color":"#2c7be50A"}]}}}],"grid":{"bottom":"-10px"}}'></div>
                      </div>
                    </div>
                    <div class="col-lg-4 border-lg-end border-bottom border-lg-0 py-3 py-lg-0">
                      <div class="d-flex flex-between-center mb-3">
                        <div class="d-flex align-items-center">
                          <div class="icon-item icon-item-sm bg-soft-primary shadow-none me-2 bg-soft-info"><span class="fs--2 fas fa-user text-info"></span></div>
                          <h6 class="mb-0">Danru</h6>
                        </div>
                        <div class="dropdown font-sans-serif btn-reveal-trigger"><button class="btn btn-link text-600 btn-sm dropdown-toggle dropdown-caret-none btn-reveal" type="button" id="dropdown-new-users" data-bs-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--2"></span></button>
                          <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="dropdown-new-users"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                            <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                          </div>
                        </div>
                      </div>
                      <div class="d-flex">
                        <div class="d-flex">
                          <p class="font-sans-serif lh-1 mb-1 fs-4 pe-2"><?= $danru?></p>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 pt-3 pt-lg-0">
                      <div class="d-flex flex-between-center mb-3">
                        <div class="d-flex align-items-center">
                          <div class="icon-item icon-item-sm bg-soft-primary shadow-none me-2 bg-soft-success"><span class="fs--2 fas fa-user text-info "></span></div>
                          <h6 class="mb-0">Korlap</h6>
                        </div>
                        <div class="dropdown font-sans-serif btn-reveal-trigger"><button class="btn btn-link text-600 btn-sm dropdown-toggle dropdown-caret-none btn-reveal" type="button" id="dropdown-new-leads" data-bs-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--2"></span></button>
                          <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="dropdown-new-leads"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                            <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                          </div>
                        </div>
                      </div>
                      <div class="d-flex">
                        <div class="d-flex">
                          <p class="font-sans-serif lh-1 mb-1 fs-4 pe-2"><?= $korlap?></p>
                        
                        </div>
                        <div class="echart-crm-statistics w-100 ms-2" data-echart-responsive="true" data-echarts='{"series":[{"type":"line","data":[200,150,175,130,150,115,130,100],"color":"#00d27a","areaStyle":{"color":{"colorStops":[{"offset":0,"color":"#00d27a3A"},{"offset":1,"color":"#00d27a0A"}]}}}],"grid":{"bottom":"-10px"}}'></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header d-flex flex-between-center ps-0 py-0 border-bottom">
                  <ul class="nav nav-tabs border-0 flex-nowrap tab-active-caret" id="crm-revenue-chart-tab" role="tablist" data-tab-has-echarts="data-tab-has-echarts">
                    <li class="nav-item" role="presentation"><a class="nav-link py-3 mb-0 active" id="crm-revenue-tab" data-bs-toggle="tab" href="#crm-revenue" role="tab" aria-controls="crm-revenue" aria-selected="true">Revenue</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link py-3 mb-0" id="crm-users-tab" data-bs-toggle="tab" href="#crm-users" role="tab" aria-controls="crm-users" aria-selected="false">Users</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link py-3 mb-0" id="crm-deals-tab" data-bs-toggle="tab" href="#crm-deals" role="tab" aria-controls="crm-deals" aria-selected="false">Deals</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link py-3 mb-0" id="crm-profit-tab" data-bs-toggle="tab" href="#crm-profit" role="tab" aria-controls="crm-profit" aria-selected="false">Profit</a></li>
                  </ul>
                  <div class="dropdown font-sans-serif btn-reveal-trigger"><button class="btn btn-link text-600 btn-sm dropdown-toggle dropdown-caret-none btn-reveal" type="button" id="dropdown-session-by-country" data-bs-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--2"></span></button>
                    <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="dropdown-session-by-country"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                      <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row g-1">
                    <div class="col-xxl-3">
                      <div class="row g-0 my-2">
                        <div class="col-md-6 col-xxl-12">
                          <div class="border-xxl-bottom border-xxl-200 mb-2">
                            <h2 class="text-primary">$37,950</h2>
                            <p class="fs--2 text-500 fw-semi-bold mb-0"><span class="fas fa-circle text-primary me-2"></span>Closed Amount</p>
                            <p class="fs--2 text-500 fw-semi-bold"><span class="fas fa-circle text-warning me-2"></span>Revenue Goal</p>
                          </div>
                          <div class="form-check form-check-inline me-2"><input class="form-check-input" id="crmInbound" type="radio" name="bound" value="inbound" Checked="Checked" /><label class="form-check-label" for="crmInbound">Inbound</label></div>
                          <div class="form-check form-check-inline"><input class="form-check-input" id="outbound" type="radio" name="bound" value="outbound" /><label class="form-check-label" for="outbound">Outbound</label></div>
                        </div>
                        <div class="col-md-6 col-xxl-12 py-2">
                          <div class="row mx-0">
                            <div class="col-6 border-end border-bottom py-3">
                              <h5 class="fw-normal text-600">$4.2k</h5>
                              <h6 class="text-500 mb-0">Email</h6>
                            </div>
                            <div class="col-6 border-bottom py-3">
                              <h5 class="fw-normal text-600">$5.6k</h5>
                              <h6 class="text-500 mb-0">Social</h6>
                            </div>
                            <div class="col-6 border-end py-3">
                              <h5 class="fw-normal text-600">$6.7k</h5>
                              <h6 class="text-500 mb-0">Call</h6>
                            </div>
                            <div class="col-6 py-3">
                              <h5 class="fw-normal text-600">$2.3k</h5>
                              <h6 class="text-500 mb-0">Other</h6>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xxl-9">
                      <div class="tab-content">
                        <!-- Find the JS file for the following chart at: src/js/charts/echarts/crm-revenue.js-->
                        <!-- If you are not using gulp based workflow, you can find the transpiled code at: public/assets/js/theme.js-->
                        <div class="tab-pane active" id="crm-revenue" role="tabpanel" aria-labelledby="crm-revenue-tab">
                          <div class="echart-crm-revenue" data-echart-responsive="true" data-echart-tab="data-echart-tab" style="height:320px;"></div>
                        </div>
                        <div class="tab-pane" id="crm-users" role="tabpanel" aria-labelledby="crm-users-tab">
                          <div class="echart-crm-users" data-echart-responsive="true" data-echart-tab="data-echart-tab" style="height:320px;"></div>
                        </div>
                        <div class="tab-pane" id="crm-deals" role="tabpanel" aria-labelledby="crm-deals-tab">
                          <div class="echart-crm-deals" data-echart-responsive="true" data-echart-tab="data-echart-tab" style="height:320px;"></div>
                        </div>
                        <div class="tab-pane" id="crm-profit" role="tabpanel" aria-labelledby="crm-profit-tab">
                          <div class="echart-crm-profit" data-echart-responsive="true" data-echart-tab="data-echart-tab" style="height:320px;"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
           
            <div class="col-xxl-4">
              <div class="card h-100">
                <div class="card-header d-flex flex-between-center border-bottom py-2">
                  <h6 class="mb-0">Deal Storage Funnel</h6><a class="btn btn-link btn-sm px-0 shadow-none" href="#!">View Details<span class="fas fa-chevron-right ms-1 fs--2"></span></a>
                </div>
                <div class="card-body">
                  <div class="row rtl-row-reverse g-1">
                    <div class="col">
                      <div class="d-flex flex-between-center rtl-row-reverse">
                        <h6 class="fs--2 text-500">Deal Stage</h6>
                        <h6 class="fs--2 text-500">Count of Deals</h6>
                      </div>
                    </div>
                    <div class="col-auto">
                      <h6 class="fs--2 text-500">Conversion </h6>
                    </div>
                  </div><!-- Find the JS file for the following chart at: src/js/charts/echarts/deal-storage-funnel.js-->
                  <!-- If you are not using gulp based workflow, you can find the transpiled code at: public/assets/js/theme.js-->
                  <div class="echart-deal-storage-funnel" data-echart-responsive="true" data-options='{"data":[7,10,13,19,19],"dataAxis1":["Processing","Contact won","Contact Sent","Qualified to Buy","Created"],"dataAxis2":["50%","70%","76%","68%","99%"]}'></div>
                </div>
              </div>
            </div>
         
           
          </div>
          <div class="row g-3 mb-3">
            <div class="col-lg-5">
              <div class="card h-100">
                <div class="card-header border-bottom">
                  <h6 class="mb-0">To Do List</h6>
                </div>
                <div class="card-body p-0 overflow-hidden">
                  <div class="row gx-3 align-items-center my-3 px-card">
                    <div class="col-auto">
                      <h6 class="text-primary mb-0">25%</h6>
                    </div>
                    <div class="col">
                      <div class="progress rounded-pill" style="height: 0.5625rem;">
                        <div class="progress-bar bg-progress-gradient rounded-pill" role="progressbar" style="width: 75%" aria-valuenow="43.72" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                  <div class="d-flex justify-content-between hover-actions-trigger btn-reveal-trigger px-card hover-bg-100">
                    <div class="form-check mb-0 d-flex align-items-center"><input class="form-check-input rounded-3 form-check-line-through p-2 mt-0 form-check-input-undefined" type="checkbox" id="crm-checkbox-todo-0" /><label class="form-check-label mb-0 p-3" for="crm-checkbox-todo-0">Design a ad</label></div>
                    <div class="d-flex align-items-center">
                      <div class="hover-actions"><button class="btn icon-item rounded-3 me-2 fs--2 icon-item-sm"><span class="fas fa-clock"></span></button><button class="btn icon-item rounded-3 me-2 fs--2 icon-item-sm"><span class="fas fa-user-plus"> </span></button></div>
                      <div class="dropdown font-sans-serif btn-reveal-trigger"><button class="btn btn-link text-600 btn-sm dropdown-toggle dropdown-caret-none btn-reveal-sm transition-none" type="button" id="crm-to-do-list-0" data-bs-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--2"></span></button>
                        <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="crm-to-do-list-0"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                          <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="d-flex justify-content-between hover-actions-trigger btn-reveal-trigger px-card hover-bg-100">
                    <div class="form-check mb-0 d-flex align-items-center"><input class="form-check-input rounded-3 form-check-line-through p-2 mt-0 form-check-input-undefined" type="checkbox" id="crm-checkbox-todo-1" /><label class="form-check-label mb-0 p-3" for="crm-checkbox-todo-1">Analyze Data</label></div>
                    <div class="d-flex align-items-center">
                      <div class="hover-actions"><button class="btn icon-item rounded-3 me-2 fs--2 icon-item-sm"><span class="fas fa-clock"></span></button><button class="btn icon-item rounded-3 me-2 fs--2 icon-item-sm"><span class="fas fa-user-plus"> </span></button></div>
                      <div class="dropdown font-sans-serif btn-reveal-trigger"><button class="btn btn-link text-600 btn-sm dropdown-toggle dropdown-caret-none btn-reveal-sm transition-none" type="button" id="crm-to-do-list-1" data-bs-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--2"></span></button>
                        <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="crm-to-do-list-1"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                          <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="d-flex justify-content-between hover-actions-trigger btn-reveal-trigger px-card hover-bg-100">
                    <div class="form-check mb-0 d-flex align-items-center"><input class="form-check-input rounded-3 form-check-line-through p-2 mt-0 form-check-input-undefined" type="checkbox" id="crm-checkbox-todo-2" /><label class="form-check-label mb-0 p-3" for="crm-checkbox-todo-2">Youtube campaign</label></div>
                    <div class="d-flex align-items-center">
                      <div class="hover-actions"><button class="btn icon-item rounded-3 me-2 fs--2 icon-item-sm"><span class="fas fa-clock"></span></button><button class="btn icon-item rounded-3 me-2 fs--2 icon-item-sm"><span class="fas fa-user-plus"> </span></button></div>
                      <div class="dropdown font-sans-serif btn-reveal-trigger"><button class="btn btn-link text-600 btn-sm dropdown-toggle dropdown-caret-none btn-reveal-sm transition-none" type="button" id="crm-to-do-list-2" data-bs-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--2"></span></button>
                        <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="crm-to-do-list-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                          <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="d-flex justify-content-between hover-actions-trigger btn-reveal-trigger px-card hover-bg-100">
                    <div class="form-check mb-0 d-flex align-items-center"><input class="form-check-input rounded-3 form-check-line-through p-2 mt-0 form-check-input-undefined" type="checkbox" id="crm-checkbox-todo-3" /><label class="form-check-label mb-0 p-3" for="crm-checkbox-todo-3">Assaign employee</label></div>
                    <div class="d-flex align-items-center">
                      <div class="hover-actions"><button class="btn icon-item rounded-3 me-2 fs--2 icon-item-sm"><span class="fas fa-clock"></span></button><button class="btn icon-item rounded-3 me-2 fs--2 icon-item-sm"><span class="fas fa-user-plus"> </span></button></div>
                      <div class="dropdown font-sans-serif btn-reveal-trigger"><button class="btn btn-link text-600 btn-sm dropdown-toggle dropdown-caret-none btn-reveal-sm transition-none" type="button" id="crm-to-do-list-3" data-bs-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--2"></span></button>
                        <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="crm-to-do-list-3"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                          <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="d-flex justify-content-between hover-actions-trigger btn-reveal-trigger px-card hover-bg-100">
                    <div class="form-check mb-0 d-flex align-items-center"><input class="form-check-input rounded-3 form-check-line-through p-2 mt-0 form-check-input-undefined" type="checkbox" id="crm-checkbox-todo-4" /><label class="form-check-label mb-0 p-3" for="crm-checkbox-todo-4">Video Conference</label></div>
                    <div class="d-flex align-items-center">
                      <div class="hover-actions"><button class="btn icon-item rounded-3 me-2 fs--2 icon-item-sm"><span class="fas fa-clock"></span></button><button class="btn icon-item rounded-3 me-2 fs--2 icon-item-sm"><span class="fas fa-user-plus"> </span></button></div>
                      <div class="dropdown font-sans-serif btn-reveal-trigger"><button class="btn btn-link text-600 btn-sm dropdown-toggle dropdown-caret-none btn-reveal-sm transition-none" type="button" id="crm-to-do-list-4" data-bs-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--2"></span></button>
                        <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="crm-to-do-list-4"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                          <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer bg-light p-0"><a class="btn btn-sm btn-link d-block py-2" href="#!"><span class="fas fa-plus me-1 fs--2"></span>Add New Task</a></div>
              </div>
            </div>
            <div class="col-lg-7">
              <div class="card" id="TableCrmRecentLeads" data-list='{"valueNames":["name","email","status"],"page":8,"pagination":true}'>
                <div class="card-header d-flex flex-between-center py-2">
                  <h6 class="mb-0">Recent Leads</h6>
                  <div class="dropdown font-sans-serif btn-reveal-trigger"><button class="btn btn-link text-600 btn-sm dropdown-toggle dropdown-caret-none btn-reveal" type="button" id="recent-leads-header-dropdownundefined" data-bs-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--2"></span></button>
                    <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="recent-leads-header-dropdownundefined"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                      <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                    </div>
                  </div>
                </div>
                <div class="card-body px-0 py-0">
                  <div class="table-responsive scrollbar">
                    <table class="table fs--1 mb-0">
                      <thead class="bg-200 text-800">
                        <tr>
                          <th class="py-3 white-space-nowrap" style="max-width: 30px;">
                            <div class="form-check mb-0 d-flex align-items-center"><input class="form-check-input" id="checkbox-bulk-leads-select" type="checkbox" data-bulk-select='{"body":"table-recent-leads-body","actions":"table-recent-leads-actions","replacedElement":"table-recent-leads-replace-element"}' /></div>
                          </th>
                          <th class="sort align-middle" data-sort="name">Name</th>
                          <th class="sort align-middle" data-sort="email">Email and Phone</th>
                          <th class="sort align-middle" data-sort="status">Status</th>
                          <th class="sort align-middle text-end">Action</th>
                        </tr>
                      </thead>
                      <tbody class="list" id="table-recent-leads-body">
                        <tr class="hover-actions-trigger btn-reveal-trigger hover-bg-100">
                          <td class="align-middle" style="max-width: 30px;">
                            <div class="form-check mb-0"><input class="form-check-input" type="checkbox" id="recent-leads-0" data-bulk-select-row="data-bulk-select-row" /></div>
                          </td>
                          <td class="align-middle white-space-nowrap"><a href="../pages/user/profile.html">
                              <div class="d-flex align-items-center">
                                <div class="avatar avatar-xl">
                                  <img class="rounded-circle" src="../assets/img/team/1-thumb.png" alt="" />
                                </div>
                                <h6 class="mb-0 ps-2 text-800 name">Kerry Ingram</h6>
                              </div>
                            </a></td>
                          <td class="align-middle white-space-nowrap text-primary email"><a href="mailto:john@gmail.com">john@gmail.com</a></td>
                          <td class="align-middle white-space-nowrap"><small class="badge fw-semi-bold rounded-pill status badge-soft-primary"> New Lead</small></td>
                          <td class="align-middle white-space-nowrap text-end position-relative">
                            <div class="hover-actions bg-100"><button class="btn icon-item rounded-3 me-2 fs--2 icon-item-sm"><span class="far fa-edit"></span></button><button class="btn icon-item rounded-3 me-2 fs--2 icon-item-sm"><span class="far fa-comment"></span></button></div>
                            <div class="dropdown font-sans-serif btn-reveal-trigger"><button class="btn btn-link text-600 btn-sm dropdown-toggle dropdown-caret-none btn-reveal-sm transition-none" type="button" id="crm-recent-leads-0" data-bs-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--2"></span></button>
                              <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="crm-recent-leads-0"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                                <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr class="hover-actions-trigger btn-reveal-trigger hover-bg-100">
                          <td class="align-middle" style="max-width: 30px;">
                            <div class="form-check mb-0"><input class="form-check-input" type="checkbox" id="recent-leads-1" data-bulk-select-row="data-bulk-select-row" /></div>
                          </td>
                          <td class="align-middle white-space-nowrap"><a href="../pages/user/profile.html">
                              <div class="d-flex align-items-center">
                                <div class="avatar avatar-xl">
                                  <img class="rounded-circle" src="../assets/img/team/2-thumb.png" alt="" />
                                </div>
                                <h6 class="mb-0 ps-2 text-800 name">Bradie Knowall</h6>
                              </div>
                            </a></td>
                          <td class="align-middle white-space-nowrap text-primary email"><a href="mailto:bradie@mail.ru">bradie@mail.ru</a></td>
                          <td class="align-middle white-space-nowrap"><small class="badge fw-semi-bold rounded-pill status badge-soft-primary"> New Lead</small></td>
                          <td class="align-middle white-space-nowrap text-end position-relative">
                            <div class="hover-actions bg-100"><button class="btn icon-item rounded-3 me-2 fs--2 icon-item-sm"><span class="far fa-edit"></span></button><button class="btn icon-item rounded-3 me-2 fs--2 icon-item-sm"><span class="far fa-comment"></span></button></div>
                            <div class="dropdown font-sans-serif btn-reveal-trigger"><button class="btn btn-link text-600 btn-sm dropdown-toggle dropdown-caret-none btn-reveal-sm transition-none" type="button" id="crm-recent-leads-1" data-bs-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--2"></span></button>
                              <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="crm-recent-leads-1"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                                <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr class="hover-actions-trigger btn-reveal-trigger hover-bg-100">
                          <td class="align-middle" style="max-width: 30px;">
                            <div class="form-check mb-0"><input class="form-check-input" type="checkbox" id="recent-leads-2" data-bulk-select-row="data-bulk-select-row" /></div>
                          </td>
                          <td class="align-middle white-space-nowrap"><a href="../pages/user/profile.html">
                              <div class="d-flex align-items-center">
                                <div class="avatar avatar-xl">
                                  <img class="rounded-circle" src="../assets/img/team/3-thumb.png" alt="" />
                                </div>
                                <h6 class="mb-0 ps-2 text-800 name">Jenny Horas</h6>
                              </div>
                            </a></td>
                          <td class="align-middle white-space-nowrap text-primary email"><a href="mailto:jenny@mail.ru">jenny@mail.ru</a></td>
                          <td class="align-middle white-space-nowrap"><small class="badge fw-semi-bold rounded-pill status badge-soft-warning"> Cold Lead</small></td>
                          <td class="align-middle white-space-nowrap text-end position-relative">
                            <div class="hover-actions bg-100"><button class="btn icon-item rounded-3 me-2 fs--2 icon-item-sm"><span class="far fa-edit"></span></button><button class="btn icon-item rounded-3 me-2 fs--2 icon-item-sm"><span class="far fa-comment"></span></button></div>
                            <div class="dropdown font-sans-serif btn-reveal-trigger"><button class="btn btn-link text-600 btn-sm dropdown-toggle dropdown-caret-none btn-reveal-sm transition-none" type="button" id="crm-recent-leads-2" data-bs-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--2"></span></button>
                              <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="crm-recent-leads-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                                <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr class="hover-actions-trigger btn-reveal-trigger hover-bg-100">
                          <td class="align-middle" style="max-width: 30px;">
                            <div class="form-check mb-0"><input class="form-check-input" type="checkbox" id="recent-leads-3" data-bulk-select-row="data-bulk-select-row" /></div>
                          </td>
                          <td class="align-middle white-space-nowrap"><a href="../pages/user/profile.html">
                              <div class="d-flex align-items-center">
                                <div class="avatar avatar-xl">
                                  <img class="rounded-circle" src="../assets/img/team/4-thumb.png" alt="" />
                                </div>
                                <h6 class="mb-0 ps-2 text-800 name">Chris Pratt</h6>
                              </div>
                            </a></td>
                          <td class="align-middle white-space-nowrap text-primary email"><a href="mailto:pratt@mail.ru">pratt@mail.ru</a></td>
                          <td class="align-middle white-space-nowrap"><small class="badge fw-semi-bold rounded-pill status badge-soft-warning"> New Lead</small></td>
                          <td class="align-middle white-space-nowrap text-end position-relative">
                            <div class="hover-actions bg-100"><button class="btn icon-item rounded-3 me-2 fs--2 icon-item-sm"><span class="far fa-edit"></span></button><button class="btn icon-item rounded-3 me-2 fs--2 icon-item-sm"><span class="far fa-comment"></span></button></div>
                            <div class="dropdown font-sans-serif btn-reveal-trigger"><button class="btn btn-link text-600 btn-sm dropdown-toggle dropdown-caret-none btn-reveal-sm transition-none" type="button" id="crm-recent-leads-3" data-bs-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--2"></span></button>
                              <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="crm-recent-leads-3"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                                <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr class="hover-actions-trigger btn-reveal-trigger hover-bg-100">
                          <td class="align-middle" style="max-width: 30px;">
                            <div class="form-check mb-0"><input class="form-check-input" type="checkbox" id="recent-leads-4" data-bulk-select-row="data-bulk-select-row" /></div>
                          </td>
                          <td class="align-middle white-space-nowrap"><a href="../pages/user/profile.html">
                              <div class="d-flex align-items-center">
                                <div class="avatar avatar-xl">
                                  <img class="rounded-circle" src="../assets/img/team/5-thumb.png" alt="" />
                                </div>
                                <h6 class="mb-0 ps-2 text-800 name">Andy Murray</h6>
                              </div>
                            </a></td>
                          <td class="align-middle white-space-nowrap text-primary email"><a href="mailto:andy@gmail.com">andy@gmail.com</a></td>
                          <td class="align-middle white-space-nowrap"><small class="badge fw-semi-bold rounded-pill status badge-soft-success"> Won Lead</small></td>
                          <td class="align-middle white-space-nowrap text-end position-relative">
                            <div class="hover-actions bg-100"><button class="btn icon-item rounded-3 me-2 fs--2 icon-item-sm"><span class="far fa-edit"></span></button><button class="btn icon-item rounded-3 me-2 fs--2 icon-item-sm"><span class="far fa-comment"></span></button></div>
                            <div class="dropdown font-sans-serif btn-reveal-trigger"><button class="btn btn-link text-600 btn-sm dropdown-toggle dropdown-caret-none btn-reveal-sm transition-none" type="button" id="crm-recent-leads-4" data-bs-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--2"></span></button>
                              <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="crm-recent-leads-4"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                                <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="card-footer bg-light p-0">
                  <div class="pagination d-none"></div><a class="btn btn-sm btn-link d-block py-2" href="#!">Show full list<span class="fas fa-chevron-right ms-1 fs--2"></span></a>
                </div>
              </div>
            </div>
          </div>