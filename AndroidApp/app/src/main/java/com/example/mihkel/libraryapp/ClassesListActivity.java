package com.example.mihkel.libraryapp;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.Toast;

import java.util.ArrayList;
import java.util.List;

public class ClassesListActivity extends Activity {
        ListView listView ;
        
        @Override
        protected void onCreate(Bundle savedInstanceState) {
            super.onCreate(savedInstanceState);
            setContentView(R.layout.activity_reading_schools);

            DatabaseLayerImpl databaseLayer = new DatabaseLayerImpl();
            
            // Get ListView object from xml
            listView = (ListView) findViewById(R.id.schoolsList);
            
//            // Defined Array values to show in ListView
//            String[] values = new String[] { "Android List View",
//                                             "Adapter implementation",
//                                             "Simple List View In Android",
//                                             "Create List View Android",
//                                             "Android Example",
//                                             "List View Source Code",
//                                             "List View Array Adapter",
//                                             "Android Example List View"
//                                            };
    
            // Define a new Adapter
            // First parameter - Context
            // Second parameter - Layout for the row
            // Third parameter - ID of the TextView to which the data is written
            // Forth - the Array of data

            List<String> list = new ArrayList<String>(databaseLayer.getClasses(1).values());

    
            ArrayAdapter<String> adapter = new ArrayAdapter<String>(this,
              android.R.layout.simple_list_item_1, android.R.id.text1, list);
    
    
            // Assign adapter to ListView
            listView.setAdapter(adapter); 
            
            // ListView Item Click Listener
            listView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
 
                  @Override
                  public void onItemClick(AdapterView<?> parent, View view,
                     int position, long id) {
                    
                   // ListView Clicked item index
                   int itemPosition     = position;
                   
                   // ListView Clicked item value
                   String  itemValue    = (String) listView.getItemAtPosition(position);
                      
                    // Show Alert 
                    Toast.makeText(getApplicationContext(),
                      "Position :"+itemPosition+"  ListItem : " +itemValue , Toast.LENGTH_LONG)
                      .show();
                    Intent calendarStartIntent = new Intent(getApplication(), BooksListActivity.class);
                    startActivity(calendarStartIntent);
//        }
                 
                  }
    
             }); 
        }

//        public void onClick(View v) {
//            toast("start");
//            Intent calendarStartIntent = new Intent(this, SchoolsListActivity.class);
//            startActivity(calendarStartIntent);
//        }
//
//         public void toast(String text) {
//            Toast.makeText(getApplicationContext(), text, Toast.LENGTH_SHORT).show();
//        }
    
    }