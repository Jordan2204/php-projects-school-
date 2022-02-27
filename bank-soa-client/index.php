<?php
    include("functions.php");

    if(isset($_GET['code']) && isset($_GET['delete'])){
        //delete an account
        delete($_GET['code']);
    }

    if(isset($_POST['create_account'])){
        //delete an account
        create($_POST['code'], $_POST['balance'], $_POST['creation_date']);
    }

    if(isset($_POST['transfer'])){
        //delete an account
        transfer($_POST['code_src'], $_POST['code_dest'], $_POST['balance']);
    }

    if(isset($_POST['w_d'])){
        if($_POST['operation_type'] == "d"){
            deposit($_POST['code'], $_POST['balance']);
        }else{
            withdraw($_POST['code'], $_POST['balance']);
        }

       
    }

    // var_dump($accounts);
    // exit(0);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/scripts/tailwind.js"></script>
    <script src="/scripts/alpine.js" defer></script>
    <title>SOA PROJECT</title>
</head>
<body>
    <div class="container mx-auto">
        <h1 class="flex justify-center py-5 text-3xl font-semibold">
            SOA Project BankService
        </h1>
        <div class="w-full text-gray-900 bg-gray-100">
            <div class="p-4 flex">
                <h1 class="text-3xl">
                    Account List
                </h1>
            </div>
            <div class="px-3 py-2 flex justify-center">
            <table class="w-4/6 text-md bg-white shadow-md rounded mb-2">
                <tbody>
                    <tr class="border-b">
                        <th class="text-left p-3 px-5">Code</th>
                        <th class="text-left p-3 px-5">Balance</th>
                        <th class="text-left p-3 px-5">Creation date</th>
                        <th></th>
                    </tr>

                    <?php foreach ($accounts->return as $i => $account) { ?>
                        <tr class="border-b hover:bg-blue-100">
                            <td class="p-2 px-5"><input type="text" class="flex justify-start bg-transparent"><?php echo $account->code;?></td>
                            <td class="p-2 px-5"><input type="text" class="flex justify-start bg-transparent"><?php echo $account->balance;?></td>
                            <td class="p-2 px-5"><?php echo $account->creation_date;?></td>
                            <td class="p-2 px-5 flex justify-end">
                               <button type="button" class="text-sm bg-red-500 hover:bg-red-700 text-white py-1 mt-2 px-2 rounded focus:outline-none focus:shadow-outline">
                                <a class="flex justify-center" href="index.php?code=<?php echo $account->code;?>&delete=true">
                                <svg svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg> <span></span>
                                </a></button></td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
              
        </div>
        </div>

    <div class="h-screen bg-gray-100 flex justify-center pt-5 items-center">

            <!--actual component start-->
            <div class="w-full" x-data="setup()">
                <ul class="flex justify-center items-center my-4">
                    <template x-for="(tab, index) in tabs" :key="index">
                        <li class="cursor-pointer py-2 px-4 text-gray-500 border-b-8"
                            :class="activeTab===index ? 'text-blue-500 border-blue-500' : ''" @click="activeTab = index"
                            x-text="tab"></li>
                    </template>
                </ul>

                <div class="w-full p-2 lg:w-2/5 md:w-1/2 w-2/3 text-center mx-auto border">
                    <div x-show="activeTab===0">
                        <div class="px-4">
                            <form method="post" action="" class="bg-white p-5 rounded-lg shadow-lg min-w-full">
                                <h1 class="text-center text-2xl mb-2 text-gray-600 font-bold font-sans">New Account</h1>
                                <div>
                                    <label class="flex justify-start text-gray-800 font-semibold block my-3 text-md" for="code">Code</label>
                                    <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="number" name="code" placeholder="code" />
                                </div>

                                <div>
                                    <label class="flex justify-start text-gray-800 font-semibold block my-3 text-md" for="code">Amount</label>
                                    <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="number" name="balance" placeholder="balance" />
                                </div>

                                <div>
                                    <label class="flex justify-start text-gray-800 font-semibold block my-3 text-md" for="code">Creation date</label>
                                    <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="date" name="creation_date" placeholder="date" />
                                </div>
                                <input type="hidden" name="create_account">
                                                
                                <button type="submit" class="w-full mt-6 bg-blue-600 hover:bg-blue-800 rounded-lg px-4 py-2 text-lg text-white tracking-wide font-semibold font-sans">Create</button>
                            </form>
                        </div>
                    </div>
                    <div x-show="activeTab===1">
                    <div class="px-4">
                            <form method="post" action="" class="bg-white p-5 rounded-lg shadow-lg min-w-full">
                                <h1 class="text-center text-2xl mb-2 text-gray-600 font-bold font-sans">Deposit/withdraw</h1>
                                <div>
                                    <label class="flex justify-start text-gray-800 font-semibold block my-3 text-md" for="code">Code</label>
                                    <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="number" name="code" placeholder="code" />
                                </div>

                                <div>
                                    <label class="flex justify-start text-gray-800 font-semibold block my-3 text-md" for="code">Amount</label>
                                    <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="number" name="balance" placeholder="balance" />
                                </div>

                                <div>
                                    <label class="flex justify-start text-gray-800 font-semibold block my-3 text-md" for="code">Operation type</label>
                                    <select id="" name="operation_type" autocomplete=""
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        <option value="w">withdraw</option>
                                        <option value="d">Deposit</option>
                                    </select>
                                </div>
                                <input type="hidden" name="w_d">
                                                
                                <button type="submit" class="w-full mt-6 bg-blue-600 hover:bg-blue-800 rounded-lg px-4 py-2 text-lg text-white tracking-wide font-semibold font-sans">Proceed</button>
                            </form>
                        </div>
                    </div>
                    <div x-show="activeTab===2">
                    <div class="px-4">
                            <form method="post" action="" class="bg-white p-5 rounded-lg shadow-lg min-w-full">
                                <h1 class="text-center text-2xl mb-2 text-gray-600 font-bold font-sans">Transfer</h1>
                                <div>
                                    <label class="flex justify-start text-gray-800 font-semibold block my-3 text-md" for="code">Account code src</label>
                                    <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="number" name="code_src" placeholder="code" />
                                </div>

                                <div>
                                    <label class="flex justify-start text-gray-800 font-semibold block my-3 text-md" for="code">Account code dest</label>
                                    <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="number" name="code_dest" placeholder="code" />
                                </div>

                                <div>
                                    <label class="flex justify-start text-gray-800 font-semibold block my-3 text-md" for="code">Amount</label>
                                    <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="number" name="balance" placeholder="balance" />
                                </div>

                                
                                <input type="hidden" name="transfer">
                                                
                                <button type="submit" class="w-full mt-6 bg-blue-600 hover:bg-blue-800 rounded-lg px-4 py-2 text-lg text-white tracking-wide font-semibold font-sans">Proceed</button>
                            </form>
                        </div>
                    </div>
               </div>

                <ul class="flex justify-center items-center my-4">
                    <template x-for="(tab, index) in tabs" :key="index">
                        <li class="cursor-pointer py-3 px-4 rounded transition"
                            :class="activeTab===index ? 'bg-blue-500 text-white' : ' text-blue-500'" @click="activeTab = index"
                            x-text="tab"></li>
                    </template>
                </ul>
                
                <div class="flex gap-4 justify-center border-t p-4">
                    <button
                        class="py-2 px-4 border rounded-md border-blue-600 text-blue-600 cursor-pointer uppercase text-sm font-bold hover:bg-blue-500 hover:text-white hover:shadow"
                        @click="activeTab--" x-show="activeTab>0"
                        >Back</button>
                    <button
                        class="py-2 px-4 border rounded-md border-blue-600 text-blue-600 cursor-pointer uppercase text-sm font-bold hover:bg-blue-500 hover:text-white hover:shadow"
                        @click="activeTab++" x-show="activeTab<tabs.length-1"
                        >Next</button>
                </div>
            </div>
            <!--actual component end-->
      
    </div>
            
    </div>

    <script>
        function setup() {
        return {
        activeTab: 0,
        tabs: [
            "Create",
            "Deposit/withdraw",
            "Transfert",
        ]
        };
    };
    </script>
   
</body>
</html>