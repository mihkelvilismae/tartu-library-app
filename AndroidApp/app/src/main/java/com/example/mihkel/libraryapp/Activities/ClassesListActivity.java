package com.example.mihkel.libraryapp.Activities;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ListView;

import com.example.mihkel.libraryapp.Various.AppManagerSingleton;
import com.example.mihkel.libraryapp.Various.DatabaseLayerImpl;
import com.example.mihkel.libraryapp.Various.DatabaseManagerSingleton;
import com.example.mihkel.libraryapp.Interfaces.ParseStringCallBackListener;
import com.example.mihkel.libraryapp.Item.Clazz;
import com.example.mihkel.libraryapp.Item.Item;
import com.example.mihkel.libraryapp.Various.JsonTask;
import com.example.mihkel.libraryapp.Various.ListAdapter;
import com.example.mihkel.libraryapp.R;

import java.util.ArrayList;
import java.util.List;

public class ClassesListActivity extends Activity implements ParseStringCallBackListener {
    ListView listView;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_class_list);

        DatabaseLayerImpl databaseLayer = new DatabaseLayerImpl();

        // Get ListView object from xml
        listView = (ListView) findViewById(R.id.schoolsList);

        List<Item> list = new ArrayList<Item>(databaseLayer.getClasses(AppManagerSingleton.selectedSchoolId).values());


//        ArrayAdapter<Clazz> adapter = new ArrayAdapter<Clazz>(this,
//                android.R.layout.simple_list_item_1, android.R.id.text1, list);
        ListAdapter adapter = new ListAdapter(this, R.layout.table_row, list);

        // Assign adapter to ListView
        listView.setAdapter(adapter);

        // ListView Item Click Listener
        listView.setOnItemClickListener(new AdapterView.OnItemClickListener() {

            @Override
            public void onItemClick(AdapterView<?> parent, View view,
                                    int position, long id) {

                // ListView Clicked item index
                int itemPosition = position;

                // ListView Clicked item value
                Clazz itemValue = (Clazz) listView.getItemAtPosition(position);

                // Show Alert
//                Toast.makeText(getApplicationContext(),
//                        "Position :" + itemPosition + "  ListItem : " + itemValue, Toast.LENGTH_LONG)
//                        .show();
                AppManagerSingleton.selectedClassId = itemValue.getId();

                if (true || !DatabaseManagerSingleton.getInstance().hasBooksListInClass(AppManagerSingleton.selectedClassId))
                    fetchDataFromServer();
                else
                    startNextActivity();

            }

        });
    }

    public void fetchDataFromServer() {
        JsonTask jsonTask = new JsonTask(ClassesListActivity.this).setListener(this);
        jsonTask.execute("http://admin-mihkelvilismae.rhcloud.com/AdminInterface/json/Nimekiri/"+AppManagerSingleton.selectedClassId);
    }

    public void startNextActivity() {
        Intent calendarStartIntent = new Intent(this, BooksListActivity.class);
        startActivity(calendarStartIntent);
    }

    @Override
    public void callback(String jsonString) {
        DatabaseManagerSingleton.getInstance().setBooksListInClassJson(AppManagerSingleton.selectedClassId, jsonString);
        startNextActivity();
    }

}