<div class="container">
    <div class="row">
        <!-- Side Menu -->
        <div class="span2">
            <?php echo $sidemenu ?>
        </div>

        <!-- Content -->
        <div class="span10 content">
            <!-- Breadcrumb -->
            <ul class="breadcrumb row">
                <li><a href="<?php echo site_url("sales") ?>">Edit Invoice</a> <span class="divider">/</span></li>
                <li class="active"><?php echo $orderid?></li>
            </ul>
            <!-- Control Buttons -->
            <div class="row">
                <button class="btn btn-primary same-btn-width" >Save</button>
                <a class="btn btn-link"  href="<?php echo site_url("sales/super_invoice") ?>">Cancel</a>
            </div>

            <!-- Form Container -->
            <div class="row myform-container">
                <div class="span8 offset1 myform box-shadow">
                    <div class="span6">
                        <h4>Quotation</h4>
                        <form>
                            <div class="row">
                                <div class="span3">
                                    <label>Customer</label>
                                    <select name="customer" id="customer_list">
                                        <option>Please Choose :</option>
                                        <?php foreach ($customers as $customer): ?>
                                            <option value="<?php echo $customer['ContactID'] ?>"
                                                <?php if ($selected_customer != NULL) {
                                                    if ($selected_customer == $customer) {
                                                        echo 'selected';
                                                    }
                                                } else {
                                                    if ($p_customer == $customer) {
                                                        echo 'selected';
                                                 }
                                            }

                                                ?>><?php echo $customer['lname'] ?></option>
                                        <?php endforeach ?>
                                    </select>

                                </div>
                                <div class="span3">
                                    <label>Date</label>
                                    <input type="text" id="datepicker" name="item_date" />
                                </div>

                            </div>
                        </form>
                    </div>
                    <!-- Order Lines Table -->
                    <table class="table table-striped">
                        <caption>Invoice Lines</caption>
                        <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Taxes</th>
                            <th>Unit Price</th>
                            <th>Untaxed Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><button type="btn btn-link" id="add"/>Add an item</button></td>
                            <td><td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        </tbody>
                    </table>
                    <!-- Total Display -->
                    <div class="row">
                        <div class="span4">
                            <div class="row">
                                <div class="span2">
                                    Days until Payment Due:
                                </div>
                                <div class="span1">
                                    <input class="span2" id="term" type="text">
                                </div>
                            </div>
                            <div class="row">
                                <div class="span2">
                                    Additional Information:
                                </div>
                                <div class="span1">
                                    <textarea rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="span3 offset1">
                            <div class="row">
                                <div class="span2">
                                    Untaxed Amount:
                                </div>
                                <div class="span1">
                                    0.00
                                </div>
                            </div>
                            <div class="row">
                                <div class="span2">
                                    Taxes:
                                </div>
                                <div class="span1">
                                    0.00
                                </div>
                            </div>
                            <div class="row">
                                <div class="span2">
                                    Deduction:
                                </div>
                                <div class="span1">
                                    <input class="span1" id="deduction" type="text">
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="span2">
                                    <b>Total:</b>
                                </div>
                                <div class="span1">
                                    <b>0.00</b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

