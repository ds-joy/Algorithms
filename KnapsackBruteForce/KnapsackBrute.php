<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
          crossorigin="anonymous">
    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="../Insertion_sort/insertion.css">
    <title>Knapsack Greedy</title>
</head>

<body>
    <!-- navigation bar -->
    <nav class="navbar navbar-expand-md navbar-dark bg-success ">
    <!-- collapse -->
        <span class="navbar-text" id="logo">
            <a class="nav-link" href="../html/home.html">Algorithms</a>
        </span>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#collapse_target">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="collapse_target">
            
        <!-- navbar menus -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="../html/home.html">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../About/About.html">ABOUT</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../Referrence/referrence.html">REFERRENCES</a>
                </li>
            </ul>
        </div>
    </nav>
              
        
    <!-- middle part -->
    <div class="container-fluid">
    <div class="row">
        <div class="col-3 col-lg-2 main">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"> 
                    <a href="../Insertion_sort/insertion.html">Insertion Sort</a>
                </li>
                <li class="list-group-item"> 
                    <a href="../Merge_sort/mergeSort.html">Merge Sort</a>
                </li>
                <li class="list-group-item"> 
                    <a href="../Quick_sort/quickSort.html">Quick Sort</a>
                </li>
                <li class="list-group-item"> 
                    <a href="../BFS/bfs.html">Bfs</a>
                </li>
                <li class="list-group-item"> 
                        <a href="../DFS/dfs.html">Dfs</a>
                </li>
                <li class="list-group-item"> 
                    <a href="../PRIM/prims.html">Prim's Algorithm</a>
                </li>
                <li class="list-group-item"> 
                    <a href="../Kruskal/kruskal.html">Kruskal's Algorithm</a>
                </li>
                <li class="list-group-item"> 
                        <a href="KnapsackBrute.html">Knapsack Brute Force</a>
                </li>

                <li class="list-group-item"> 
                    <a href="../KnapsackGreedy/knapsackGreedy.html">Knapsack(Greedy)</a>
                </li>
            </ul>
        </div> <!--col-3.. main div-->
        <div class="col-9 main ">
            <h1 id="top">Knapsack Problem Brute Force Approach</h1>
            <p class="content">
                    The knapsack problem is defined as - you are given a bag capable of holding finite weight. There are objects in front of you of different weight and different profit associated with them. Your task is to take those objects in the bag to earn a maximum profit.
            </p>

            <p class="content">
                    One Way to solve this problem is Brute force technique. In this approach we will check all the possible combinition to find out which combination gives us the maximum profit.
            </p>
            <p class="content">
                    As we have to check all the possible condition the complexity will be very high.
            </p>
    
            
            
            

            

            <!-- Code -->
            <h4 class="content"> CODE:</h4>
            <div class="bg-dark content">
            <pre class="text-white">
   
    #include &#60bits/stdc++.h>

    using namespace std;
    
    int weight[10000];
    int profit[10000];
    int x[10000];
    
    int max_weight1;
    int max_weight2;
    int count_profit1;
    int count_profit2;
    int N;
    int temporary1;
    int temporary2;
    
    void brute_force();
    void greedy();
    int partitioned(int start, int stop);
    void quick_sort(int start, int stop);
    
    
    
    
    int main()
    {
        cout << "How much object do you need : ";
        cin >> N;
    
        cout << endl << "Weight : ";
        for(int i=0;i < N;i++)
        {
            weight[i]=rand()%100;
            max_weight1 = max_weight1 + weight[i];
            cout << weight[i] << ends;
        }
        cout << endl;
    
        max_weight1 = (max_weight1 * 0.7);
        max_weight2 = max_weight1;
    
        cout << "Profit : ";
        for(int i=0;i < N;i++)
        {
            profit[i]=rand()%100;
            cout << profit[i] << ends;
        }
        cout << endl;
    
        clock_t b1,e1,b2,e2;
        b1 = clock();
        brute_force();
        e1 = clock();
        cout << "Brute Force Time : " << (double)(e1 - b1)<< endl;
        b2 = clock();
        greedy();
        e2 = clock();
        cout << "Greedy Time : " << (double)(e2 - b2)<< endl;
        return 0;
    }
                    
                    
        void brute_force()
        {
            for(int i=0; i < N; i++)
            {
                count_profit1 = 0;
                max_weight1 = max_weight2;
                for(int j=i; j < N;j++)
                {
                    if(weight[j] < = max_weight1)
                    {
                        max_weight1 = max_weight1 - weight[j];
                        count_profit1 = count_profit1 + profit[j];
                    }
                }
        
                if(count_profit2 < count_profit1)
                {
                    count_profit2 = count_profit1;
        
                    for(int j=0;j < N;j++)
                            x[j] = 0;
                    max_weight1 = max_weight2;
        
                    for(int j=0;j < N;j++)
                        if(weight[j] < = max_weight1)
                        {
                            max_weight1 = max_weight1 - weight[j];
                            x[j] = 1;
                        }
        
                }
            }
        
            cout << "N : " << N << endl;
            cout<< "W : "<< max_weight2<< endl;
            
            cout<< "Brute Force Object : ";
            for(int i=0;i < N;i++)
                if(x[i]==1)
                    cout<< i+1 << ends;
            cout << endl;
        
            cout<< "Profit : "<< count_profit2 << endl;
        }
        
                    void greedy()
                    {
                        count_profit1 = 0;
                        max_weight1 = max_weight2;
                        quick_sort(0,N-1);
                    
                        cout<< endl << "Sorted Profit : ";
                        for(int i=0;i<N;i++)
                        {
                            cout<< profit[i] << ends;
                        }
                        cout << endl;
                    
                        cout << "Weight after sorting profit : ";
                        for(int i=0;i < N;i++)
                        {
                            cout << weight[i] << ends;
                        }
                        cout << endl;
                    
                        for(int j=0;j < N;j++)
                            x[j] = 0;
                    
                        for(int i=N-1;i>=0;i--)
                        {
                            if(weight[i] < = max_weight1)
                            {
                                x[i]=1;
                                max_weight1 = max_weight1 - weight[i];
                                count_profit1 = count_profit1 + profit[i];
                            }
                        }
                    
                        cout << "Greedy Object : ";
                        for(int i=0;i < N;i++)
                            if(x[i] == 1 )
                                cout << i+1 << ends;
                        cout<< endl;
                        cout<< "Profit : "<< count_profit1<< endl;
                    
                    }
                                      
                    int partitioned(int start, int stop)
                    {
                        int pivot = profit[start];
                        int i = stop+1;
                        for(int j=stop;j>start;j--)
                        {
                            if(pivot< profit[j])
                            {
                                i--;
                                temporary1 = profit[i];
                                profit[i]=profit[j];
                                profit[j]=temporary1;
                    
                                temporary2 = weight[i];
                                weight[i]=weight[j];
                                weight[j]=temporary2;
                    
                            }
                        }
                        i--;
                        temporary1 = profit[i];
                        profit[i]=profit[start];
                        profit[start]=temporary1;
                    
                        temporary2 = weight[i];
                        weight[i]=weight[start];
                        weight[start]=temporary2;
                    
                        return i;
                    }
                    
                    void quick_sort(int start, int stop)
                    {
                        if(start < stop)
                        {
                            int position = partitioned(start, stop);
                            quick_sort(start, position-1);
                            quick_sort(position+1, stop);
                        }
                    }
                    
                    
                            
            </pre>
        </div>

        <!-- Complexity -->
        <h4 class="content">Complexity:</h4>
        <p class="content">The Complexity of Knapsack Brute Force algorithm is : O( n <sup>n</sup> )</p>
        <br>
        <br>


        </div> <!-- col 9 main div  -->
    </div> <!-- row div  -->
</div> <!-- container fluid div  -->

<nav class="navbar navbar-expand-sm bg-success navbar-dark ">
       <h5 class="text-white navbar-center" >@copyright Algorithms</h5> 
 </nav>
    

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" 
            crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"     
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" 
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" 
            crossorigin="anonymous">
    </script>
</body>
</html>