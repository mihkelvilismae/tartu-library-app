package com.example.mihkel.libraryapp;

import android.app.Activity;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.Toast;

import java.util.ArrayList;
import java.util.List;

public class SchoolsListActivity extends Activity implements CallBackListener {
        ListView listView ;
        
        @Override
        protected void onCreate(Bundle savedInstanceState) {
            super.onCreate(savedInstanceState);
            setContentView(R.layout.activity_reading_schools);

            DatabaseLayerImpl databaseLayer = new DatabaseLayerImpl();
            
            listView = (ListView) findViewById(R.id.schoolsList);
            List<String> list = new ArrayList<String>(databaseLayer.getSchools().values());

            ArrayAdapter<String> adapter = new ArrayAdapter<String>(this,
              android.R.layout.simple_list_item_1, android.R.id.text1, list);
    
    
            // Assign adapter to ListView
            listView.setAdapter(adapter); 
            
            // ListView Item Click Listener
            listView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
 
                  @Override
                  public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                    
                   // ListView Clicked item index
                   int itemPosition     = position;
                   // ListView Clicked item value
                   String  itemValue    = (String) listView.getItemAtPosition(position);

                    // Show Alert
                    Toast.makeText(getApplicationContext(),
                      "Position :"+itemPosition+"  ListItem : " +itemValue , Toast.LENGTH_LONG)
                      .show();


                    //jsonTask.setLi
                    Intent calendarStartIntent = new Intent(getApplication(), ClassesListActivity.class);
                    startActivity(calendarStartIntent);
                  }
    
             }); 
        }


    @Override
    public void callback() {
        System.out.println("caaaaaaaalbaaaaaaaaack");
        System.out.println("caaaaaaaalbaaaaaaaaack");
        System.out.println("caaaaaaaalbaaaaaaaaack");
        System.out.println("caaaaaaaalbaaaaaaaaack");
        System.out.println("caaaaaaaalbaaaaaaaaack");
        System.out.println("caaaaaaaalbaaaaaaaaack");
        System.out.println("caaaaaaaalbaaaaaaaaack");
    }
}